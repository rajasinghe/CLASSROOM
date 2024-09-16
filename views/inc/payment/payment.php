<div class="row text-dark px-3 pt-4">
                    <div class="col-lg-6 ">

                      <div class="mb-3 d-flex ">
                        <label class="form-label d-flex ">Name :</label>
                        <p id="studentName">diuth</p>
                      </div>

                      <div class="d-flex ">
                        <label class="form-label d-flex  ">NIC :</label>
                        <p id="nic">200218103171</p>
                      </div>

                    </div>
                    <div class="col-lg-6 ">

                      <div class="mb-3 d-flex ">
                        <label class="form-label d-flex  ">Batch Name : </label>
                        <p id="batchName">SD 2020</p>
                      </div>

                      <div class="d-flex ">
                        <label class="form-label d-flex ">Course Name : </label>
                        <p id="courseName">Software developer</p>
                      </div>
                    </div>
                    
                    <div class="container-fluid">
                      <div class="row">
                        <div style="background-color: brown;" class="mb-3">
                          <div class="col-12 col-md-4 px-1 d-flex ">
                            <h4 class="fs-5 my-0 text-light card-header ">Payment Details</h4>
                          </div>
                        </div>
                        <hr>
                        <div class="col-12 px-0 ">

                        </div>
                      </div>
                    </div>

                    <div class="row text-dark">

                      <div class="col-lg-6 ">
                        <div class="mb-3 d-flex ">
                          <label class="form-label d-flex ">Registration fee:</label>
                          <p id="registrationFee"></p>
                        </div>
                        <div class="mb-3 d-flex ">
                          <label class="form-label d-flex ">CBT Book Fee:</label>
                          <p id="cbtBookFee">2000</p>
                        </div>
                        <div class="mb-3 d-flex ">
                          <label class="form-label d-flex ">Examination Fee:</label>
                          <p id="examinationFee">2024</p>
                        </div>
                      </div>

                      <div class="col-lg-6 ">

                        <div class="mb-3 d-flex ">
                          <label class="form-label d-flex ">Daily diary book fee: </label>
                          <p id="dailyDiaryBookFee">2024</p>
                        </div>
                        <div class="mb-3 d-flex ">
                          <label class="form-label d-flex ">Stampfee:</label>
                          <p id="stampFee">2024</p>
                        </div>
                        <div class="mb-3">
                          <label class="form-label d-flex ">Course Fee:</label>
                          <p id="courseFee">2024</p>
                        </div>

                      </div>

                    </div>
                    
                    <div class="container-fluid">
                      <div class="row">
                        <div style="background-color: brown;" class="mb-3">
                          <div class="col-12 col-md-4 px-1 d-flex ">
                            <h4 class="fs-5 my-0 text-light card-header ">Payment Method</h4>
                          </div>
                        </div>
                        <hr>
                        <div class="col-12 px-0 ">

                        </div>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-sm-12 pt-4 pb-6 px-4 text-dark">
                        <div class="form mb-2">
                          <div class=" pb-3 ">
                            <input type="radio"  id="fullpayment" name="paymentMethod" value="full_payment" class="payment_method">
                            <label for="html">full Payments</label>
                          </div>

                          <div class="mb-2">
                             <input type="radio"  id="specialPayment" name="paymentMethod" value="special" class="payment_method">
                            <label for="">Low-Income (samurdhi/aswesuma)</label>
                            <p class="ms-1  badge bg-danger  " id='specialPaymentNote'></p>  
                          </div>

                          <div class="">
                            <input type="radio"  id="installment" name="paymentMethod" value="installment" class="payment_method">
                            <label for="html">Installments</label><br>
                          </div>

                          <div class="invalid-tooltip position-relative  " id="paymentMethodToolTip">
                            Please choose payment method .
                          </div>
                          </form>

                          <div class="my-3">
                            <div class="">
                              <label for="" class="form-label  ">Amount : </label>
                              <input type="text" class="form-control" id="paidAmount" placeholder="">
                            </div>
                            <div class="invalid-tooltip position-relative " id="paidAmountTooltip">
                              Please choose payment method.
                            </div>
                          </div>
                        </div>
                      </div>


                     

                    </div>

                     <!--slip details heading -->
                     <div class="container-fluid">
                        <div class="row">
                          <div style="background-color: brown;" class="mb-3">
                            <div class="col-12 col-md-4 px-1 d-flex ">
                              <h4 class="fs-5 my-0 text-light card-header ">Payment Slip Details</h4>
                            </div>
                          </div>
                          <hr>
                          <div class="col-12 px-0 ">

                          </div>
                        </div>
                      </div>
                      <div>
                        <div class="">
                          <label>Reference Number :</label>
                          <input type="text" class="form-control pt-2  d-flex  mb-2" id="ReferenceNumber" placeholder="">
                          <div class=" valid-tooltip position-relative " id="referenceNumberToolTip">sssss</div>
                        </div>
                        <div class="mt-3  ">
                          <P class="text-dark ">Picture a clear photo of the slip</P>
                          <input type="file" id="paymentSlipImage" class="text-dark form-control mb-2">
                          <div class=" valid-tooltip position-relative " id="imageToolTip">sssss</div>
                        </div>
                      </div>
                      <div class="d-flex mt-3">
                            <button class="btn btn-danger ms-auto" type="button" id="continueButton">Continue</button>
                      </div>
                    </div>
</div>