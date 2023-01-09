<div class="col-12 d-flex justify-content-center">
    <div class="form_wrapper">
        <div class="form_container" id="add_advert">
            <div class="title_container">
                <h2>Add Advertisement</h2>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form
                            action="Scripts/Php/adverts.php"
                            method="POST"
                            enctype="multipart/form-data"
                    >
                        <div class="row">
                            <div class="col-6 my-auto">
                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-map-marker"></i
                          ></span>
                                    <input
                                            type="text"
                                            id="g_location"
                                            name="g_location"
                                            placeholder="Location"
                                            required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-tag"></i
                          ></span>
                                    <input
                                            type="number"
                                            id="g_amount"
                                            name="g_amount"
                                            placeholder="Amount (in kg)"
                                            required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-tag"></i
                          ></span>
                                    <select name="g_type" id="g_type" class="select_option" required>
                                        <option value="default" disabled selected hidden>Type of Garbage</option>
                                        <option value="Papers">Papers</option>
                                        <option value="Plastics">Plastics</option>
                                        <option value="Metals">Metals</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">


                            <label for="g_period">Grace Period:</label>
                            <div class="input_field">
                                
                                    <span><i aria-hidden="true" class="fa fa-calendar"></i
                                        ></span>
                                    <input
                                            id="g_period"
                                            type="date"
                                            name="g_period"
                                            placeholder="Grace Period"
                                            required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-dollar"></i
                          ></span>
                                    <input
                                            type="number"
                                            id="g_price"
                                            name="g_price"
                                            placeholder="Price (Rs. per kg)"
                                            required
                                    />
                                </div>


                                <?php
                                echo('<input type="hidden" name="rep_id" value="' . $_SESSION['id'] . '" />');
                                ?>
                                <input
                                        name="add_advert"
                                        class="button"
                                        type="submit"
                                        value="Add"
                                />
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="form_container" id="edit_advert" style="display: none;">
            <div class="title_container">
                <h2>Edit Advertisement <span id="edit_advert_index"></span></h2>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form
                            action="Scripts/Php/adverts.php"
                            method="POST"
                            enctype="multipart/form-data"
                    >
                    <div class="row">
                            <div class="col-6 my-auto">
                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-map-marker"></i
                          ></span>
                                    <input
                                            type="text"
                                            id="edit_g_location"
                                            name="g_location"
                                            placeholder="Location"
                                            required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-tag"></i
                          ></span>
                                    <input
                                            type="number"
                                            id="edit_g_amount"
                                            name="g_amount"
                                            placeholder="Amount (in kg)"
                                            required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-tag"></i
                          ></span>
                                    <select name="g_type" id="edit_g_type" class="select_option" required>
                                        <option value="default" disabled selected hidden>Type of Garbage</option>
                                        <option value="Papers">Papers</option>
                                        <option value="Plastics">Plastics</option>
                                        <option value="Metals">Metals</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">


                            <label for="g_period">Grace Period:</label>
                            <div class="input_field">
                                
                                    <span><i aria-hidden="true" class="fa fa-calendar"></i
                                        ></span>
                                    <input
                                            id="edit_g_period"
                                            type="date"
                                            name="g_period"
                                            placeholder="Grace Period"
                                            required
                                    />
                                </div>

                                <div class="input_field">
                      <span
                      ><i aria-hidden="true" class="fa fa-dollar"></i
                          ></span>
                                    <input
                                            type="number"
                                            id="edit_g_price"
                                            name="g_price"
                                            placeholder="Price (Rs. per kg)"
                                            required
                                    />
                                </div>
                                
                              


                                 <input type="hidden" id="edit_advert_id" name="advert_id" />
                                <div class="row">
                                    <div class="col-6">
                                        <?php
                                        echo('<input type="hidden" name="rep_id" value="' . $_SESSION['id'] . '" />');
                                        ?>
                                        <input
                                                name="edit_advert"
                                                class="my-auto rounded-2 button w-100"
                                                type="submit"
                                                value="Update"
                                        />
                                    </div>
                                    <div class="col-6">
                                        <a href="adverts.php" class="btn btn-warning w-100">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
