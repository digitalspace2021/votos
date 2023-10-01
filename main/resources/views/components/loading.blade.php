@push('custom-css')
<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        /* Fondo semi-transparente */
        display: flex;
        justify-content: center;
        /* Centrar horizontalmente */
        align-items: center;
        /* Centrar verticalmente */
        z-index: 9999;
        /* Z-index alto para que se superponga a otros elementos */
    }

    .loading-spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        /* Animación de rotación */
    }

    /* Animación de rotación */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #content-options {
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        gap: 3rem;
    }
</style>
@endpush

<div class="loading-overlay" style="display: none;">
    <div class="loading-spinner"></div>
</div>