const API = 'http://177.44.248.85/ahlert/projeto/backend/veiculos'; 
const form = document.getElementById('form');
const marcaInput = document.getElementById('marca');
const modeloInput = document.getElementById('modelo');
const tipoInput = document.getElementById('tipo');
const anoInput = document.getElementById('ano');
const corInput = document.getElementById('cor');
const statusInput = document.getElementById('status');

form.addEventListener('submit', async e => {
    // pausa o envio do submit para controlarmos manualmente
    e.preventDefault();

    const payload = {
        marca: marcaInput.value,
        modelo: modeloInput.value,
        tipo: tipoInput.value,
        ano: Number(anoInput.value),
        cor: corInput.value,
        status: statusInput.value
    };

    try {
        const res = await fetch(API, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (res.ok) {
            window.location.href = 'index.html';
        } else {
            throw new Error(res.statusText);
        }
    } catch (err) {
        alert('Erro ao cadastrar: ' + err);
    }
});