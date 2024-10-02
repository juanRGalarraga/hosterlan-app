import Swal from "sweetalert2";

export default class Alert {

    static error({title, text}) {
        Swal.fire({
            icon: 'error',
            title,
            text,
        });
    }

    static debug({title, text}) {
        Swal.fire({
            icon: 'info',
            title,
            text,
        });
    }

    static success({title, text}) {
        Swal.fire({
            icon: 'success',
            title,
            text,
        });
    }

    static warning({title, text}) {
        Swal.fire({
            icon: 'warning',
            title,
            text,
        });
    }

    static confirm({title, text, confirmButtonText, cancelButtonText, confirmAction}) {
        Swal.fire({
            title,
            text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText,
            cancelButtonText,
        }).then((result) => {
            if (result.isConfirmed) {
                confirmAction()
            }
        });
    }

    static confirmDelete({title, text, confirmAction}) {
        this.confirm({
            title,
            text,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            confirmAction
        });
    }

    static confirmUpdate({title, text, confirmAction}) {
        this.confirm({
            title,
            text,
            confirmButtonText: 'Actualizar',
            cancelButtonText: 'Cancelar',
            confirmAction
        });
    }

    static confirmCreate({title, text, confirmAction}) {
        this.confirm({
            title,
            text,
            confirmButtonText: 'Crear',
            cancelButtonText: 'Cancelar',
            confirmAction
        });
    }
    
}