async function carregarHistorico() {
    const dados = await consultarDados();
    dadosAtuais(dados[0])

    return dados.map((dado) => {
        return {
            imc: dado.peso / (dado.altura / 100) ** 2,
            data_cadastro: new Date(dado.data_cadastro).toLocaleString("pt-BR").split(' ')[0],
        }
    })
}

function dadosAtuais(dado) {
    document.getElementById("peso-atual").innerHTML = dado.peso+'Kg';
    document.getElementById("altura-atual").innerHTML = dado.altura+'cm';
    document.getElementById("imc-atual").innerHTML = (dado.peso / (dado.altura / 100) ** 2).toFixed(2)+'kg/m²';
}

async function consultarDados() {
    const domain = 'http://localhost:8080/server/service/Imc.php'

    return fetch(domain)
        .then(response => response.json()) // retorna uma promise
        .then(result => result)
        .catch(err => console.error('Failed retrieving information', err));
}
