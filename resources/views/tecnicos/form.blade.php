    <div class="row">
        <div class=" col-md-6">
            <label for="inputEmail4">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required
            value="{{ isset($cliente->user->name)?$cliente->user->name:old('Nombre') }}"
            >
        </div>

        <div class="col-md-6">
            <label for="inputEmail4">Correo/Uasuario</label>
            <input type="email" class="form-control" id="usuario" name="usuario" required
            value="{{ isset($cliente->user->email)?$cliente->user->email:old('usuario') }}"
            >
        </div>
       
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" required
            value="{{ isset($cliente->user->password)?$cliente->user->password:old('contraseña') }}"
            >


        </div>

        <div class="col-md-6">
        <label for="inputAddress">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Puebla" required
        value="{{ isset($cliente->direccion)?$cliente->direccion:old('direccion') }}"
        >
        </div>
    </div>

    <div class="form-group">
        
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputEmail4">Teléfono </label>
            <input type="number" class="form-control" id="tel_1" name="tel_1" required
            value="{{ isset($cliente->telefono)?$cliente->telefono:old('tel_1') }}">
        </div>
    </div>
 
    <div class="row mb-3">    
                        <label class="col-md-4 col-form-label text-md-end" for="role">Role</label>
                        <div class="col-md-6">
                        <select id="role" class="form-control" name="role">
                            @foreach($roles as $role)
                                @if($role->id == 2)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>  
                        </div>  
                       
<button type="submit" class="btn btn-primary mt-2" >{{ $modo }}</button>