const API = 'http://177.44.248.85/ahlert/projeto/backend/veiculos';

async function carregarDados() {
    try {
        const res = await fetch(API);
        const veiculos = await res.json();

        let total = veiculos.length;
        let emManut = veiculos.filter(v => v.status === "Manutenção").length;
        document.getElementById('totalVeiculos').textContent = total;
        document.getElementById('veiculosManutencao').textContent = emManut;

    } catch (err) {
        alert('Erro ao carregar dados: ' + err);
    }
}

carregarDados();