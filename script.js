$(document).ready(function() {
    let contadorExperiencias = 0;
    let contadorReferencias = 0;

    $('#add-experiencia').click(function() {
        contadorExperiencias++;

        const html = `
            <div class="experiencia-item">
                <h2>Experiência:${contadorExperiencias}</h2>

                <label for="cargo${contadorExperiencias}">Cargo:</label>
                <input type="text" id="cargo${contadorExperiencias}" name="experiencia[cargo][]">

                <label for="empresa${contadorExperiencias}">Empresa:</label>
                <input type="text" id="empresa${contadorExperiencias}" name="experiencia[empresa][]">

                <label for="periodo${contadorExperiencias}">Período:</label>
                <input type="text" id="periodo${contadorExperiencias}" name="experiencia[periodo][]">
            </div>
        `;

        $('#experiencias').append(html);
    });

    $('#add-referencia').click(function() {
        contadorReferencias++;

        const html = `
            <div class="referencia-item">
                <h2>Referência:${contadorReferencias}</h2>
                
                <label for="nomeRef${contadorReferencias}">Nome:</label>
                <input type="text" id="nomeRef${contadorReferencias}" name="referencia[nome][]">

                <label for="contatoRef${contadorReferencias}">Contato:</label>
                <input type="text" id="contatoRef${contadorReferencias}" name="referencia[contato][]">
            </div>
        `;

        $('#referencias').append(html);
    });

    $('#dataNascimento').change(function() {
        const dataNascimento = new Date($(this).val());
        const hoje = new Date();
        let idade = hoje.getFullYear() - dataNascimento.getFullYear();

        if (hoje.getMonth() < dataNascimento.getMonth() || 
            (hoje.getMonth() === dataNascimento.getMonth() && hoje.getDate() < dataNascimento.getDate())) {
            idade--;
        }

        $('#idade').val(idade);
    });
});