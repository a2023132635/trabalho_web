let saldo = parseFloat(localStorage.getItem("saldo")) || 0;
let poupanca = parseFloat(localStorage.getItem("poupanca")) || 0;
let divida = parseFloat(localStorage.getItem("divida")) || 0;


function guardarValores() {
    localStorage.setItem("saldo", saldo);
    localStorage.setItem("poupanca", poupanca);
    localStorage.setItem("divida", divida);
}

function atualizarSaldoGestao() {
    const elemento = document.getElementById("saldo");
    if (elemento) elemento.innerText = `€ ${saldo.toFixed(2)}`;
}


function atualizarIndex() {
    document.getElementById("saldoIndex").innerText = `€ ${saldo.toFixed(2)}`;
    document.getElementById("poupancaIndex").innerText = `€ ${poupanca.toFixed(2)}`;
    document.getElementById("dividaIndex").innerText = `€ ${divida.toFixed(2)}`;
}

function carregarSaldoEventos() {
    document.getElementById("saldoEventos").innerText = `€ ${saldo.toFixed(2)}`;
}

function mostrarInput(tipo) {
  const inputs = ["inputGasto","inputPoupar","inputDivida","inputInvestir"];
  inputs.forEach(id => document.getElementById(id).style.display = "none");

  document.getElementById(`input${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`).style.display = "block";
}


function receberSalario() {
  let valor = parseFloat(document.getElementById("valorSalario").value);
  if (isNaN(valor) || valor <= 0) return;

  saldo += valor;
  guardarValores();
  atualizarSaldoGestao();

  document.getElementById("mensagem").innerText = `Recebeste €${valor}.`;
  document.getElementById("valorSalario").value = "";
}

function gastar() {
  let valor = parseFloat(document.getElementById("valorGasto").value);
  if (isNaN(valor) || valor <= 0 || valor > saldo) return;

  saldo -= valor;
  guardarValores();
  atualizarSaldoGestao();

  document.getElementById("mensagem").innerText = `Gastaste €${valor}.`;
  document.getElementById("inputGasto").style.display = "none";
}

function poupar() {
  let valor = parseFloat(document.getElementById("valorPoupar").value);
  if (isNaN(valor) || valor <= 0 || valor > saldo) return;

  saldo -= valor;
  poupanca += valor;
  
  guardarValores();
  atualizarSaldoGestao();

  document.getElementById("mensagem").innerText = `Poupaste €${valor}.`;
  document.getElementById("inputPoupar").style.display = "none";
}

function pagarDivida() {
  let valor = parseFloat(document.getElementById("valorDivida").value);
  if (isNaN(valor) || valor <= 0 || valor > saldo) return;

  saldo -= valor;
  divida -= valor;

  guardarValores();
  atualizarSaldoGestao();

  document.getElementById("mensagem").innerText = `Pagaste €${valor}.`;
  document.getElementById("inputDivida").style.display = "none";
}

function investir() {
  let valor = parseFloat(document.getElementById("valorInvestir").value);
  if (isNaN(valor) || valor <= 0 || valor > saldo) return;

  saldo -= valor;

  guardarValores();
  atualizarSaldoGestao();

  document.getElementById("mensagem").innerText = `Investiste €${valor}.`;
  document.getElementById("inputInvestir").style.display = "none";
}


function gerarEvento() {
  const eventos = [
    { nome: "Horas extra no trabalho", valor: 150 },
    { nome: "Despesa hospitalar inesperada", valor: -150 },
    { nome: "Subsídio Extra", valor: 500 },
    { nome: "Problema automóvel inesperado", valor: -200 }
  ];

  const evento = eventos[Math.floor(Math.random() * eventos.length)];

  saldo += evento.valor;
  guardarValores();

  document.getElementById("descricaoEvento").innerText =
    `${evento.nome} (${evento.valor > 0 ? "+" : ""}${evento.valor}€)`;

  document.getElementById("resultadoEvento").innerText =
    `Novo saldo: € ${saldo.toFixed(2)}`;

  document.getElementById("saldoEventos").innerText = `€ ${saldo.toFixed(2)}`;
}



function registarUtilizador(event) {
    event.preventDefault();

    const email = document.getElementById("f-email").value;
    const nome = document.getElementById("f-nome").value;
    const apelido = document.getElementById("f-apelido").value;
    const password = document.getElementById("f-password").value;

    const utilizador = {
        email: email,
        nome: nome,
        apelido: apelido,
        password: password
    };

    localStorage.setItem("utilizadorRegistado", JSON.stringify(utilizador));

    window.location.href = "login.html";
}



function loginUtilizador(event) {
    event.preventDefault();

    const emailLogin = document.getElementById("login-email").value;
    const passwordLogin = document.getElementById("login-password").value;

    const utilizadorGuardado = JSON.parse(localStorage.getItem("utilizadorRegistado"));

    if (!utilizadorGuardado) {
        alert("Nenhum utilizador registado.");
        return;
    }

    if (emailLogin === utilizadorGuardado.email &&
        passwordLogin === utilizadorGuardado.password) {

        localStorage.setItem("utilizadorAtivo", JSON.stringify(utilizadorGuardado));

        window.location.href = "perfil.html";
    } else {
        alert("Email ou palavra-passe incorretos!");
    }
}
