async function carregarExercicios() {
    const dados = await consultarDados();

    dados.map((dado) => {
        const lista = document.getElementById('catalogo-videos')
        const div = document.createElement('div');
        div.innerHTML = adiconarVideo(dado)
        lista.appendChild(div)
    })
}

function adiconarVideo(dado) {
    return `
    <div class="row">
        <div class="col-lg-4">
            <a href="` + dado.videoPath + `"><img src="` + dado.imgPath + `" class="img-fluid" alt="video"/></a>
        </div>
        <div class="col-lg-8">
            <h4>` + dado.titulo + `</h4>
            <i class="fas fa-star" style="color: #D7D0DD"></i>
            <i class="fas fa-star" style="color: #D7D0DD"></i>
            <i class="fas fa-star" style="color: #D7D0DD"></i>
            <i class="fas fa-star" style="color: #D7D0DD"></i>
            <i class="fas fa-star" style="color: #D7D0DD"></i>

            <p>Descrição: ` + dado.descricao + `</p>
            <p>Calorias: ` + dado.calorias + `kcal</p>
            <div class="chip">
                <div class="chip-content">` + dado.categoria[0] + `</div>
            </div>
        </div>
    </div>
    <hr style="color:#bebebe" />`
}

async function consultarDados() {
    const domain = 'http://localhost:8080/server/service/Exercicios.php'

    return fetch(domain)
        .then(response => response.json()) // retorna uma promise
        .then(result => result)
        .catch(err => console.error('Failed retrieving information', err));
}
