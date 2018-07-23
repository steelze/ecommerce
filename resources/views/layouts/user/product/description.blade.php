<section class="product-description no-padding">
    <div class="container">
        <ul role="tablist" class="nav nav-tabs flex-column flex-sm-row">
            <li class="nav-item"><a data-toggle="tab" href="#description" role="tab" class="nav-link active">Description</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#additional-information" role="tab" class="nav-link">Additional Information</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#reviews" role="tab" class="nav-link">Reviews</a></li>
        </ul>
        <div class="tab-content">
            <div id="description" role="tabpanel" class="tab-pane active">
                @if($product->description)
                    {!! $product->description !!}
                @else
                    <p class="text-center">No description Available</p>
                @endif
            </div>
            <div id="additional-information" role="tabpanel" class="tab-pane">
                <table class="table">
                    <tbody>
                    <tr>
                        <th class="border-0">Material:</th>
                        <td class="border-0">Cotton</td>
                    </tr>
                    <tr>
                        <th>Styles:</th>
                        <td>Casual</td>
                    </tr>
                    <tr>
                        <th>Properties:</th>
                        <td>Short Sleeve</td>
                    </tr>
                    <tr>
                        <th>Brand:</th>
                        <td>Calvin Klein</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="reviews" role="tabpanel" class="tab-pane">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="row review">
                            <div class="col-3 text-center"><img src="../../../d19m59y37dris4.cloudfront.net/hub/1-4-0/img/person-1.jpg" alt="Han Solo" class="review-image"><span class="text-uppercase text-muted text-small">Dec 2018</span></div>
                            <div class="col-9 review-text">
                            <h6>Han Solo</h6>
                            <div class="mb-2"><i class="fa fa-star text-primary"></i><i class="fa fa-star text-primary"></i><i class="fa fa-star text-primary"></i><i class="fa fa-star text-primary"></i><i class="fa fa-star text-primary"></i>
                            </div>
                            <p class="text-muted text-small">One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>