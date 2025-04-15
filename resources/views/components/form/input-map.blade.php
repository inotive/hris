<div>
 
 
    <x-form.input type="text" label="Latitude" name="lat" :value="$form->lat ?? ''" />
    <x-form.input type="text" label="Longitude" name="lng" :value="$form->lng ?? ''" />

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapModal">
        Pick Location
    </button>

    <!-- Modal -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                   
                    <input type="text" id="searchBox" class="form-control mb-2" placeholder="Search address...">
                    <div id="map" style="height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button id="saveLocation" class="btn btn-success">Save Location</button>
                </div>
            </div>
        </div>
    </div>

</div>