@props([
'lat' => '',
'lng' => '',
])
<div>


    <x-form.hidden type="text" label="Latitude" name="lat" :value="$lat ?? ''" />
    <x-form.hidden type="text" label="Longitude" name="lng" :value="$lng ?? ''" />

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapModal">
        {{ __('Pick Location') }}
    </button>

    <div id="mapview" class="mt-2 rounded" style="height: 200px;width:100%"></div>

    <!-- Modal -->
    <div class="modal fade" id="mapModal" aria-hidden="false" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h5 class="modal-title -ml-1">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </h5>
                    <button id="saveLocation" type="button" class="btn btn-primary">{{ __('Save') }}</button>

                </div>
                <div class="modal-body p-0" style="height: 550px;">

                    <input type="text" autocomplete="off" id="searchBox" class="form-control border-0"
                        placeholder="Search address...">
                    <div id="map" style="height: 450px;"></div>

                    <div id="selectedAddress" class="p-2 text-muted"></div>
                </div>

            </div>
        </div>
    </div>

</div>