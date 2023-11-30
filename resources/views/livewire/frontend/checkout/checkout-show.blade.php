<div class="py-3 py-md-4 checkout">
    <div class="container">
        <h4>Checkout</h4>
        <hr>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        Item Total Amount :
                        <span class="float-end">${{$totalAmount}}</span>
                    </h4>
                    <hr>
                    <small>* Items will be delivered in 3 - 5 days.</small>
                    <br/>
                    <small>* Tax and other charges are included ?</small>
                </div>
            </div>
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        Basic Information
                    </h4>
                    <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" wire:model="fullname" placeholder="Enter Full Name" />
                                @error('fullname')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="number" name="phone" id="phone" wire:model="phone" class="form-control" placeholder="Enter Phone Number" />
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email Address</label>
                                <input type="email" name="email" wire:model="email" id="email"  readonly class="form-control" placeholder="Enter Email Address" />
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pin-code (Zip-code)</label>
                                <input type="number" name="pincode"  wire:model="pincode" id="pincode" class="form-control" placeholder="Enter Pin-code" />
                                @error('pincode')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea name="address" wire:model="address" class="form-control" id="address" rows="2"></textarea>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Select Payment Mode: </label>
                                <div class="d-md-flex align-items-start">
                                    <div class="nav col-md-3 flex-column nav-pills me-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link fw-bold border border-primary mb-2 active" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                        <button class="nav-link fw-bold border border-primary" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment"  type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                    </div>
                                    <div class="tab-content col-md-9" id="v-pills-tabContent">
                                        <div class="tab-pane fade active show" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                            <h6>Cash on Delivery Mode</h6>
                                            <hr/>
                                            <button type="button" class="btn btn-primary" wire:click="codorder">Place Order (Cash on Delivery)</button>

                                        </div>
                                        <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                            <h6>Online Payment Mode</h6>
                                            <hr/>
                                                <div wire:ignore>
                                                <div id="paypal-button-container"></div></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                </div>
            </div>

        </div>
    </div>
</div>  

@push('paypalscript')
  
<script src="https://www.paypal.com/sdk/js?client-id=AW0Vyw2pbpzDke4n11lnKjQQcviAO9wTNkygFfDqxf6ON10Dmmk3qxo0O03Ydz-iEg-hTBrkL3bi0LNM&currency=USD"></script>
     
<script>
    paypal.Buttons({
        onClick()  {
            if (document.getElementById('fullname').value==''
                || document.getElementById('email').value==''
                || document.getElementById('phone').value==''
                || document.getElementById('pincode').value==''
                || document.getElementById('address').value==''
            ) {
                Livewire.emit('validationForAll');
                return false;
            }
            else{
                @this.set('fullname',document.getElementById('fullname').value);
                @this.set('email',document.getElementById('email').value);
                @this.set('phone',document.getElementById('phone').value);
                @this.set('pincode',document.getElementById('pincode').value);
                @this.set('address',document.getElementById('address').value);
            }
            },
      createOrder:function(data,actions) {
        return actions.order.create({
            application_context:{
                brand_name:'MiniFlipCart',
                user_action:'PAY_NOW'
            },
        purchase_units: [{
          amount: {
            value: "{{$totalAmount}}"
          }
        }],
        })
      },
      onApprove: function(data, actions) {

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// This function captures the funds from the transaction.
return actions.order.capture().then(function(orderData) {
      const transaction=orderData.purchase_units[0].payments.captures[0];
      if(transaction.status=='COMPLETED'){
          Livewire.emit('transactionEmit',transaction.id);
      }
});
},
    }).render('#paypal-button-container');
  </script>
@endpush

