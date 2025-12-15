// VARIÁVEIS GLOBAIS

let saldo = 0;
let poupanca = 0;
let divida = 0;

// LOCALSTORAGE

function carregarValores() {
    saldo = parseFloat(localStorage.getItem("saldo")) || 0;
    poupanca = parseFloat(localStorage.getItem("poupanca")) || 0;
    divida = parseFloat(localStorage.getItem("divida")) || 0;
}

function guardarValores() {
    localStorage.setItem("saldo", saldo);
    localStorage.setItem("poupanca", poupanca);
    localStorage.setItem("divida", divida);
}

function carregarSaldoEventos() {
    carregarValores(); // lê do localStorage

    const el = document.getElementById("saldoEventos");
    if (el) el.innerText = `€ ${saldo.toFixed(2)}`;
    
}


// ATUALIZAÇÃO DO UI

function atualizarIndex() {
  const s = document.getElementById("saldoIndex");
  const p = document.getElementById("poupancaIndex");
  const d = document.getElementById("dividaIndex");

  if (s) s.innerText = `€ ${saldo.toFixed(2)}`;
  if (p) p.innerText = `€ ${poupanca.toFixed(2)}`;
  if (d) d.innerText = `€ ${divida.toFixed(2)}`;
}

function atualizarSaldoGestao() {
    const el = document.getElementById("saldo");
    if (el) el.innerText = `€ ${saldo.toFixed(2)}`;
}

function atualizarSaldoEventos() {
    const el = document.getElementById("saldoEventos");
    if (el) el.innerText = `€ ${saldo.toFixed(2)}`;
}


// REGISTAR HISTORICO

function registarHistorico(tipo, valor) {
  fetch("sistema/registar_historico.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `tipo=${encodeURIComponent(tipo)}&valor=${valor}&saldo=${saldo}`
  });
}



// AÇÕES FINANCEIRAS

function mostrarInput(tipo) {
  const inputs = ["inputGasto","inputPoupar","inputDivida","inputInvestir"];
  inputs.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.style.display = "none";
  });

  const alvo = document.getElementById(
    `input${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`
  );
  if (alvo) alvo.style.display = "block";
}

function receberSalario() {
    const valor = parseFloat(document.getElementById("valorSalario").value);
    if (isNaN(valor) || valor <= 0) return;

    saldo += valor;
    guardarValores();
    atualizarSaldoGestao();
    atualizarIndex();

    registarHistorico("Recebeu salário", valor);
     
    document.getElementById("mensagem").innerText = `Recebeste €${valor}.`;
    document.getElementById("valorSalario").value = "";
}

function gastar() {
    const valor = parseFloat(document.getElementById("valorGasto").value);
    if (isNaN(valor) || valor <= 0 || valor > saldo) return;

    saldo -= valor;
    guardarValores();
    atualizarSaldoGestao();
    atualizarIndex();

    registarHistorico("Gasto", -valor);

    document.getElementById("mensagem").innerText = `Gastaste €${valor}.`;
    document.getElementById("inputGasto").style.display = "none";
}

function poupar() {
    const valor = parseFloat(document.getElementById("valorPoupar").value);
    if (isNaN(valor) || valor <= 0 || valor > saldo) return;

    saldo -= valor;
    poupanca += valor;
    guardarValores();
    atualizarSaldoGestao();
    atualizarIndex();

    registarHistorico("Poupança", -valor);

    document.getElementById("mensagem").innerText = `Poupaste €${valor}.`;
    document.getElementById("inputPoupar").style.display = "none";
}

function pagarDivida() {
    const valor = parseFloat(document.getElementById("valorDivida").value);
    if (isNaN(valor) || valor <= 0 || valor > saldo) return;

    saldo -= valor;
    divida -= valor;
    guardarValores();
    atualizarSaldoGestao();
    atualizarIndex();

    registarHistorico("Pagamento de dívida", -valor);

    document.getElementById("mensagem").innerText = `Pagaste €${valor}.`;
    document.getElementById("inputDivida").style.display = "none";
}

function investir() {
    const valor = parseFloat(document.getElementById("valorInvestir").value);
    if (isNaN(valor) || valor <= 0 || valor > saldo) return;

    saldo -= valor;
    guardarValores();
    atualizarSaldoGestao();
    atualizarIndex();

    registarHistorico("Investimento", -valor);

    document.getElementById("mensagem").innerText = `Investiste €${valor}.`;
    document.getElementById("inputInvestir").style.display = "none";
}

// EVENTOS

function gerarEvento() {
  const eventos = [
    { nome: "Horas extra no trabalho", valor: 350 },
    { nome: "Ganho de uma aposta", valor: 150 },
    { nome: "Problema automóvel inesperado", valor: -425 },
    { nome: "Viagem", valor: -500 },
  ];

  const evento = eventos[Math.floor(Math.random() * eventos.length)];

  saldo += evento.valor;
  guardarValores();

  document.getElementById("descricaoEvento").innerText =
    `${evento.nome} (${evento.valor > 0 ? "+" : ""}${evento.valor}€)`;

  document.getElementById("resultadoEvento").innerText =
    `Novo saldo: € ${saldo.toFixed(2)}`;

  atualizarSaldoEventos();

  registarHistorico(evento.nome, evento.valor);
}



// GUARDAR NA BASE DE DADOS

function guardarProgressoBD() {
    fetch("sistema/guardar_financas.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `saldo=${saldo}&poupanca=${poupanca}&divida=${divida}`
    })
    .then(r => r.text())
    .then(res => {
        if (res.trim() === "ok") {
            alert("Progresso guardado com sucesso!");
        } 
        else {
            alert("Erro ao guardar: " + res);
        }
    });
}

// RESET TOTAL

function resetFinancas() {
    if (!confirm("Queres mesmo resetar tudo para 0?")) return;

    saldo = 0;
    poupanca = 0;
    divida = 0;

    guardarValores();
    atualizarIndex();
    atualizarSaldoGestao();
    atualizarSaldoEventos();

    fetch("sistema/reset_financas.php", { method: "POST" });
}


// INICIALIZAÇÃO (UMA VEZ APENAS)

document.addEventListener("DOMContentLoaded", () => {
  fetch("sistema/carregar_financas.php")
    .then(r => r.json())
    .then(data => {
      saldo = parseFloat(data.saldo) || 0;
      poupanca = parseFloat(data.poupanca) || 0;
      divida = parseFloat(data.divida) || 0;

      guardarValores();
      atualizarIndex();
      atualizarSaldoGestao();
      atualizarSaldoEventos();
    })
    .catch(() => {
      carregarValores();
      atualizarIndex();
      atualizarSaldoGestao();
      atualizarSaldoEventos();
    });
});







