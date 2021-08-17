async function carregarEventos() {
    const dados = await consultarDados();

    const lista = document.getElementById('eventos_saude')

    dados.forEach((dado) => {
        //div pai
        const innerDivPai = document.createElement('div');
        innerDivPai.className = 'evento_saude p-4 row d-flex justify-content-center align-items-center'

        //div filho
        const innerDivFilho = montarEvento(dado)
        const innerDivFilho2 = montarDataELocal(dado)

        innerDivPai.appendChild(innerDivFilho)
        innerDivPai.appendChild(innerDivFilho2)

        lista.appendChild(innerDivPai)
    })
}

function montarEvento(dado) {
    const innerDivFilho = document.createElement('div');
    innerDivFilho.className = 'col d-flex flex-column justify-content-left align-items-left'
    const span1 = document.createElement('span');
    const span2 = document.createElement('span');
    span1.innerHTML = '<strong>Evento:</strong> ' + dado.descricao_evento
    span2.innerHTML = '<strong>Nome:</strong> ' + dado.nome

    innerDivFilho.appendChild(span1)
    innerDivFilho.appendChild(span2)

    return innerDivFilho;
}

function montarDataELocal(dado) {
    const innerDivFilho = document.createElement('div');
    innerDivFilho.className = 'col d-flex flex-column justify-content-left align-items-left'
    const span1 = document.createElement('span');
    const span2 = document.createElement('span');
    span1.innerHTML = '<strong>Data e Hora:</strong> ' + new Date(dado.data_e_hora).toLocaleString("pt-BR")
    span2.innerHTML = '<strong>Local:</strong> ' + dado.local

    innerDivFilho.appendChild(span1)
    innerDivFilho.appendChild(span2)

    return innerDivFilho;
}

async function consultarDados() {
    const domain = 'http://localhost:8080/server/service/EventoSaude.php'

    return fetch(domain)
        .then(response => response.json()) // retorna uma promise
        .then(result => result)
        .catch(err => console.error('Failed retrieving information', err));
}
