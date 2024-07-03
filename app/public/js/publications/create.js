let form = document.getElementById("publicationForm");
let preview = document.getElementById("preview");

document.addEventListener("DOMContentLoaded", function () {
    // updatePreview();
    // form.addEventListener("change", function() {
    //     updatePreview();
    // });
    
    // form.elements["image"].addEventListener("change", function(event) {
    //     updatePreview();
    // });
});

// function updatePreview() {
//     const rentType = form.elements["rent_type"].value || 'Tipo de renta';
//     const description = form.elements["description"].value || 'Descripción';
//     const price = form.elements["price"].value || '0.00';
//     const ubication = form.elements["ubication"].value || 'Ubicación';
//     const roomCount = form.elements["room_count"].value || '0';
//     const bathCount = form.elements["bath_count"].value || '0';
//     const pets = form.elements["pets"].value || 'No especificado';
//     const image = form.elements["image"]?.files[0] ?? null;

//     let imageURL = '';
//     if (image) {
//         imageURL = URL.createObjectURL(image);
//     }

//     preview.innerHTML = `
//         <h2>${rentType}</h2>
//         <div class="preview-price">$${price}/Por Noche</div>
//         <div class="preview-section">
//             <strong>Ubicación de la propiedad</strong>
//             <div class="location-placeholder">${ubication}</div>
//         </div>
//         <div class="preview-section">
//             <strong>Descripción</strong>
//             <p>${description}</p>
//         </div>
//         <div class="preview-section">
//             <strong>Número de habitaciones:</strong> ${roomCount}
//         </div>
//         <div class="preview-section">
//             <strong>Número de baños:</strong> ${bathCount}
//         </div>
//         <div class="preview-section">
//             <strong>Se aceptan mascotas:</strong> ${pets}
//         </div>
//         ${imageURL ? `<div class="preview-section"><strong>Imagen de la propiedad:</strong><br><img src="${imageURL}" alt="Vista previa de la imagen"></div>` : ''}
//        `;
// }