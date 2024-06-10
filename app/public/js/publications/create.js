document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("publicationForm");
    const preview = document.getElementById("preview");

    form.addEventListener("input", function() {
        updatePreview();
    });

    form.elements["image"].addEventListener("change", function(event) {
        updatePreview();
    });

    function updatePreview() {
        const description = form.elements["description"].value || 'Descripción';
        const price = form.elements["price"].value || '0.00';
        const ubication = form.elements["ubication"].value || 'Ubicación';
        const roomCount = form.elements["room_count"].value || '0';
        const bathCount = form.elements["bath_count"].value || '0';
        const rentType = form.elements["rent_type"].value || 'Tipo de renta';
        const pets = form.elements["pets"].value || 'No especificado';
        const image = form.elements["image"].files[0];

        let imageURL = '';
        if (image) {
            imageURL = URL.createObjectURL(image);
        }

        preview.innerHTML = `
            <h2>Vista previa</h2>
            <div><strong>Descripción:</strong> ${description}</div>
            <div><strong>Precio:</strong> ${price} $</div>
            <div><strong>Ubicación:</strong> ${ubication}</div>
            <div><strong>Número de habitaciones:</strong> ${roomCount}</div>
            <div><strong>Número de baños:</strong> ${bathCount}</div>
            <div><strong>Tipo de renta:</strong> ${rentType}</div>
            <div><strong>Se aceptan mascotas:</strong> ${pets}</div>
            ${imageURL ? `<div><strong>Imagen de la propiedad:</strong><br><img src="${imageURL}" alt="Vista previa de la imagen" style="max-width: 100%;"></div>` : ''}
        `;
    }
});
