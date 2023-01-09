<div class="col-12 d-flex justify-content-center">
    <div class="form_wrapper" >
        <div class="form_container" id="add_promotion">
            <div class="title_container">
                <h2>Add Product</h2>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form
                        action="Scripts/Php/promotions.php"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <div class="row">
                            <div class="col-5 my-auto">
                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-envelope"></i
                          ></span>
                                    <input
                                        type="text"
                                        name="product_name"
                                        placeholder="Product Name"
                                        required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-dollar"></i
                          ></span>
                                    <input
                                        type="number"
                                        name="product_price"
                                        placeholder="Price"
                                        required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-dollar"></i
                          ></span>
                                    <input
                                        type="number"
                                        name="discounted_price"
                                        placeholder="Discounted Price"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="col-4">
                                <label for="expiry_date">Expiry Date:</label>
                                <div class="input_field">
                                    <span><i aria-hidden="true" class="fa fa-calendar"></i
                                        ></span>
                                    <input
                                        type="date"
                                        name="expiry_date"
                                        placeholder="Expiry Date"
                                        required
                                    />
                                </div>

                                <div class="input_field">
                                  <span><i aria-hidden="true" class="fa fa-image"></i
                                      ></span>
                                    <input type="file" name="product_image" onchange="readImagePath(this, 'product_image')"/>
                                </div>
                                <?php
                                echo('<input type="hidden" name="business_id" value="' . $_SESSION['id'] . '" />');
                                ?>
                                <input
                                    name="add_promotion"
                                    class="button"
                                    type="submit"
                                    value="Add"
                                />
                            </div>
                            <div class="col-3">
                                <img id="product_image"
                                     src="" style="width: 220px; height: 220px; object-fit: cover;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="form_container" id="edit_promotion" style="display: none;">
            <div class="title_container">
                <h2>Edit Product <span id="edit_product_index"></span></h2>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form
                        action="Scripts/Php/promotions.php"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <div class="row">
                            <div class="col-5 my-auto">
                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-envelope"></i
                          ></span>
                                    <input
                                        type="text"
                                        name="product_name"
                                        placeholder="Product Name"
                                        value=""
                                        required
                                        id="edit_product_name"
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-dollar"></i
                          ></span>
                                    <input
                                        type="number"
                                        name="product_price"
                                        placeholder="Price"
                                        required
                                        id="edit_product_price"
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-dollar"></i
                          ></span>
                                    <input
                                        type="number"
                                        name="discounted_price"
                                        placeholder="Discounted Price"
                                        id="edit_discounted_price"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="col-4">
                                <label for="expiry_date">Expiry Date:</label>
                                <div class="input_field">
                                    <span><i aria-hidden="true" class="fa fa-calendar"></i
                                        ></span>
                                    <input
                                        type="date"
                                        name="expiry_date"
                                        placeholder="Expiry Date"
                                        id="edit_expiry_date"
                                        required
                                    />
                                </div>

                                <div class="input_field">
                                  <span><i aria-hidden="true" class="fa fa-image"></i
                                      ></span>
                                    <input type="file" name="product_image" onchange="readImagePath(this, 'edit_product_image')"/>
                                </div>
                                <input type="hidden" id="edit_product_id" name="product_id" />
                                <div class="row">
                                    <div class="col-6">
                                        <input
                                            name="edit_promotion"
                                            class="my-auto rounded-2 button w-100"
                                            type="submit"
                                            value="Update"
                                        />
                                    </div>
                                    <div class="col-6">
                                        <a href="promotions.php" class="btn btn-warning w-100">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <img id="edit_product_image"
                                     src="" style="width: 220px; height: 220px; object-fit: cover;" alt="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
