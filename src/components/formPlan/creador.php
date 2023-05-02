<form action="" method="post" class="position-relative form-container" id="formCreador">
    <h2 class="text-utec text-center header-font-custom">Especialistas/Creadores</h2>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="form-label">Especialistas ya Creados:</label>
        <select class="form-select form-select-lg" name="creador" id="creador">
            <option selected>Select one</option>
            <option value="1">New Delhi</option>
            <option value="2">Istanbul</option>
            <option value="3">Jakarta</option>
        </select>
    </div>
    <div class="w-75 mx-auto mb-2 d-flex align-items-center flex-wrap">
        <p class="font-custom m-0 me-2">¿Quieres agregar otro creador?</p>
        <button type="button" class="btn btn-outline-utec">
            <span class="icon profile-icon">
                <i class="fas fa-user-plus"></i>
            </span>
        </button>
    </div>
    <div class="w-75 mx-auto mb-2">
        <small class="font-custom">No existe el especialista/creador que quieres elegir? 
            <!-- Button trigger modal -->
            <a href="/tesis/creadores/1" class="font-custom">Crear especialista</a>
        </small>
        <div class="mt-3">
            <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formFundamentacion">
                <span class="icon profile-icon">
                    <i class="fas fa-angle-double-left"></i>
                </span>
            </button>
            <button type="button" class="btn btn-outline-utec p-0 px-2" data-bs-target="formResumen">
                <span class="icon profile-icon">
                    <i class="fas fa-angle-double-right"></i>
                </span>
            </button>
        </div>
    </div>
</form>