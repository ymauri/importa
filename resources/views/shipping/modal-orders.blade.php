<div id="areaOrdersList" class="modal fade product-list-modal" tabindex="-1" role="dialog" aria-labelledby="areaProductoList" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Listado de bultos</h5>
                <button type="button" class="close" data-dismiss="modal" on aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control search" placeholder="Buscar...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon search-btn">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
                <table class="table table-hover" style="width:100%" id="datatable_orders_modal">
                </table>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-success">Añadir</button> --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
