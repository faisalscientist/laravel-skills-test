<!-- Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editProductForm">
          <input type="hidden" id="editProductId">
          <div class="form-group">
              <label for="productName"> Product name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="editProductName" placeholder="Enter Product name">
              <small class="text-danger" id="editproductNameError"></small>
          </div>
          <div class="form-group">
              <label for="quantityInStock">Quantity in stock <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="editQuantityInStock" placeholder="Enter quantity in stock">
              <small class="text-danger" id="editquantityInStockError"></small>
          </div>
          <div class="form-group">
              <label for="pricePerItem">Price per item <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="editPricePerItem" placeholder="Enter price per item">
              <small class="text-danger" id="editpricePerItemError"></small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitEditForm">Save changes</button>
      </div>
    </div>
  </div>
</div>