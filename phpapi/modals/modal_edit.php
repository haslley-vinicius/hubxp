<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm" class="modal-content">
            <input type="hidden" name="id" id="editId">
            <div class="modal-header">
                <h5 class="modal-title">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nome</label>
                    <input type="text" name="name" id="editNome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Preço</label>
                    <input type="number" step="0.01" name="price" id="editPreco" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Atualizar</button>
            </div>
        </form>
    </div>
</div>