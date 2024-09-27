import PublicationFile from "../create/files";

let publicationFile = new PublicationFile({ inputId: "dropzone-file" });

let publicationId = document.getElementById("id").value;
publicationFile.getUploadedFiles(publicationId);