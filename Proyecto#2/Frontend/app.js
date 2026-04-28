// ──────────────────────────────────────────────
// Estado global
// ──────────────────────────────────────────────
const BACKEND_URL = 'http://localhost:8080/index.php'; // Asegúrate de que esta sea tu URL local

let lastOutput  = '';
let lastErrors  = [];
let lastSymbols = [];

// ──────────────────────────────────────────────
// Pestañas
// ──────────────────────────────────────────────
function switchTab(name) {
  ['console', 'errors', 'symbols'].forEach(t => {
    document.getElementById('tab-' + t).classList.toggle('active', t === name);
    document.getElementById('content-' + t).classList.toggle('active', t === name);
  });
}

// ──────────────────────────────────────────────
// Toolbar actions
// ──────────────────────────────────────────────
function newFile() {
  if (document.getElementById('editor').value.trim() &&
      !confirm('¿Descartar el código actual?')) return;
  document.getElementById('editor').value = '';
  clearConsole();
}

function loadFile() {
  document.getElementById('file-input').click();
}

function onFileLoaded(event) {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => { document.getElementById('editor').value = e.target.result; };
  reader.readAsText(file);
  event.target.value = '';
}

function saveFile() {
  download('programa.golampi', document.getElementById('editor').value);
}

function clearConsole() {
  document.getElementById('console-output').textContent = '';
  lastOutput  = '';
  lastErrors  = [];
  lastSymbols = [];
  setReportButtons(false);
  document.getElementById('error-badge').style.display = 'none';
  renderErrorsTable([]);
  renderSymbolsTable([]);
  document.getElementById('tab-errors').classList.remove('has-errors');
}

// ──────────────────────────────────────────────
// Compilar código 
// ──────────────────────────────────────────────
async function compileCode() {
  const code = document.getElementById('editor').value;
  if (!code.trim()) return;

  const spinner = document.getElementById('spinner');
  if (spinner) spinner.style.display = 'block';
  
  clearConsole();

  try {
    const response = await fetch(BACKEND_URL, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify({ code }),
    });

    if (!response.ok) throw new Error(`HTTP ${response.status}`);

    const data = await response.json();

    lastOutput  = data.output  ?? '';
    lastErrors  = data.errors  ?? [];
    lastSymbols = data.symbols ?? [];

    document.getElementById('console-output').textContent = lastOutput || '';

    if (lastErrors.length > 0) {
      const badge = document.getElementById('error-badge');
      badge.textContent = `${lastErrors.length} error(es)`;
      badge.style.display = 'inline-block';
      document.getElementById('tab-errors').classList.add('has-errors');
    }

    renderErrorsTable(lastErrors);
    renderSymbolsTable(lastSymbols);
    setReportButtons(true);

  } catch (err) {
    document.getElementById('console-output').textContent =
      `Error de conexión con el backend del Compilador:\n${err.message}\n\n` +
      `Verifica que el servidor PHP esté corriendo y la URL es: ${BACKEND_URL}`;
  } finally {
    if (spinner) spinner.style.display = 'none';
  }
}

// ──────────────────────────────────────────────
// Render tablas
// ──────────────────────────────────────────────
function renderErrorsTable(errors) {
  const empty = document.getElementById('errors-empty');
  const table = document.getElementById('errors-table');
  const tbody = document.getElementById('errors-body');
  tbody.innerHTML = '';

  if (!errors || errors.length === 0) {
    empty.style.display = 'block';
    table.style.display = 'none';
    return;
  }
  empty.style.display = 'none';
  table.style.display = 'table';

  errors.forEach((e, i) => {
    const t = (e.type ?? '').toLowerCase();
    const typeClass = t.includes('léx') || t.includes('lex') ? 'type-lex'
                    : t.includes('sint')                     ? 'type-sint'
                    : 'type-sem';
    const col = e.column ?? e.col ?? '';
    tbody.insertAdjacentHTML('beforeend', `
      <tr>
        <td>${i + 1}</td>
        <td class="${typeClass}">${e.type ?? ''}</td>
        <td>${e.desc ?? ''}</td>
        <td>${e.line ?? ''}</td>
        <td>${col}</td>
      </tr>`);
  });
}

function renderSymbolsTable(symbols) {
  const empty = document.getElementById('symbols-empty');
  const table = document.getElementById('symbols-table');
  const tbody = document.getElementById('symbols-body');
  tbody.innerHTML = '';

  if (!symbols || symbols.length === 0) {
    empty.style.display = 'block';
    table.style.display = 'none';
    return;
  }
  empty.style.display = 'none';
  table.style.display = 'table';

  symbols.forEach(s => {
    let valStr = '—';
    if (s.value !== null && s.value !== undefined && s.value !== '') {
        valStr = s.value;
    }
    
    // Traducir los tipos 
    let tipoStr = (s.type || '').toLowerCase();
    if (tipoStr === 'int32') tipoStr = 'entero';
    if (tipoStr === 'string') tipoStr = 'cadena';
    if (tipoStr === 'array') tipoStr = 'arreglo';
    if (tipoStr === 'función') tipoStr = 'función';

    tbody.insertAdjacentHTML('beforeend', `
      <tr>
        <td>${s.id    ?? ''}</td>
        <td>${tipoStr}</td>
        <td>${s.scope ?? ''}</td>
        <td>${valStr}</td>
        <td>${s.line  ?? ''}</td>
        <td>${s.col ?? s.column ?? ''}</td>
      </tr>`);
  });
}

// ──────────────────────────────────────────────
// Reportes / descargas
// ──────────────────────────────────────────────
function setReportButtons(enabled) {
  // Asegúrate de que estos IDs coincidan con tu HTML
  ['btn-dl-output', 'btn-dl-errors', 'btn-dl-symbols'].forEach(id => {
    if(document.getElementById(id)) {
      document.getElementById(id).disabled = !enabled;
    }
  });
}

function downloadOutput() {
  download('codigo_generado.s', lastOutput || '// Sin código generado', 'text/plain');
}

function downloadErrors() {
  const header = '#,Tipo,Descripción,Línea,Columna\n';
  if (lastErrors.length === 0) {
    download('errores.csv', header, 'text/csv');
    return;
  }
  const rows = lastErrors.map((e, i) => {
    const desc = (e.desc ?? '').replace(/"/g, '""');
    const type = (e.type ?? '').replace(/"/g, '""');
    return `${i + 1},"${type}","${desc}",${e.line ?? ''},${e.column ?? e.col ?? ''}`;
  }).join('\n');
  download('errores.csv', '\uFEFF' + header + rows, 'text/csv');
}

function downloadSymbols() {
  const header = 'Identificador,Tipo,Ámbito,Valor/Memoria,Línea,Columna\n';
  if (lastSymbols.length === 0) {
    download('tabla_simbolos.csv', header, 'text/csv');
    return;
  }
  const rows = lastSymbols.map(s => {
    const val = s.offset !== undefined ? `Offset: [x29, #${s.offset}]` : '---';
    const csvVal = val.replace(/"/g, '""');
    return `"${s.id ?? ''}","${s.type ?? ''}","${s.scope ?? ''}","${csvVal}",${s.line ?? ''},${s.col ?? s.column ?? ''}`;
  }).join('\n');
  download('tabla_simbolos.csv', '\uFEFF' + header + rows, 'text/csv');
}

// ──────────────────────────────────────────────
// Helper de descarga
// ──────────────────────────────────────────────
function download(filename, content, mime = 'text/plain') {
  const a = document.createElement('a');
  a.href     = URL.createObjectURL(new Blob([content], { type: mime + ';charset=utf-8' }));
  a.download = filename;
  a.click();
  URL.revokeObjectURL(a.href);
}

// ──────────────────────────────────────────────
// Atajos de teclado en el editor
// ──────────────────────────────────────────────
document.getElementById('editor').addEventListener('keydown', e => {
  if (e.key === 'Tab') {
    e.preventDefault();
    const ta = e.target;
    const s  = ta.selectionStart;
    ta.value = ta.value.substring(0, s) + '    ' + ta.value.substring(ta.selectionEnd);
    ta.selectionStart = ta.selectionEnd = s + 4;
  }
  if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
    compileCode();
  }
});