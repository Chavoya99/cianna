<form method="POST" action="">
                <!-- DESCRIPCIÓN -->
                <div class="mt-4 font-sans">
                    <label>Cuéntanos sobre ti</label>
                    <div class="relative">
                        <textarea id="desc" name="desc" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="Escribe algo..." maxlength="255"></textarea>
                        <div class="absolute bottom-0 right-0 mb-2 mr-2 text-gray-500">
                            <span id="char-count">0</span>/255
                        </div>
                    </div>
                </div>
                <!-- EDAD -->
                <div class="font-sans">
                    <label>Edad</label>
                    <x-custom-input id="edad" name="edad" class="block mt-1 w-full" type="number" min="18" max="35" :value="old('edad')" required autofocus autocomplete="edad" placeholder="Edad" />
                </div>
                <!-- SEXO -->
                <div class="mt-4 font-sans">
                    <label>Sexo</label>
                    <x-custom-select id="sexo" name="sexo">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </x-custom-select>
                </div>
                <!-- CARRERA -->
                <div class="mt-4 font-sans">
                    <label>Carrera</label>
                    <x-custom-select id="carrera" name="carrera">
                        <option value="ing_alim_biot">Ing. en Alimentos y Biotecnología</option>
                        <option value="ing_biom">Ing. Biómedica</option>
                        <option value="ing_civi">Ing. Civil</option>
                        <option value="ing_comp">Ing. Computación</option>
                        <option value="ing_com_elec">Ing. en Comunicaciones y Eléctrónica</option>
                        <option value="ing_log_trans">Ing. en Logística y Transporte</option>
                        <option value="ing_topo">Ing. en Topografía Geomática</option>
                        <option value="ing_foto">Ing. Fotónica</option>
                        <option value="ing_indu">Ing. Industrial</option>
                        <option value="ing_info">Ing. Informática</option>
                        <option value="ing_meca">Ing. Mecánica Eléctrica</option>
                        <option value="ing_quim">Ing. Química</option>
                        <option value="ing_robo">Ing. Robótica</option>
                        <option value="lic_cien_mate">Lic. en Ciencia de Materiales</option>
                        <option value="lic_fis">Lic. en Física</option>
                        <option value="lic_mate">Lic. en Matemáticas</option>
                        <option value="lic_quim">Lic. en Química</option>
                        <option value="lic_qfb">Lic. en Químico Farmacéutico Biólogo</option>
                    </x-custom-select>
                </div>
                <!-- CÓDIGO -->
                <div class="mt-4 font-sans">
                    <label>Código de estudiante</label>
                    <x-custom-input id="codigo" name="codigo" class="block mt-1 w-full" type="number" minlength="9" maxlength="9" :value="old('codigo')" required autocomplete="codigo" placeholder="" />
                </div>
                <!-- GUSTOS E INTERESES -->
                <div class="mt-4 font-sans">
                    <label>Gustos e intereses</label>
                    <div class="mt-4">
                        <x-custom-checkbox id="ejemplo1" name="gust_int[]" value="ejemplo1" label="Ejemplo 1" />
                        <x-custom-checkbox id="ejemplo2" name="gust_int[]" value="ejemplo2" label="Ejemplo 2" class="mt-2" />
                        <x-custom-checkbox id="ejemplo3" name="gust_int[]" value="ejemplo3" label="Ejemplo 3" class="mt-2" />
                    </div>
                </div>
                <!-- FOTO DE PERFIL -->
                <div class="mt-4 font-sans">
                    <label>Foto de perfil</label>
                    <x-foto-perfil>
                    Esta será tu foto de perfil
                    </x-foto-perfil>
                </div>
                <!-- KARDEX -->
                <div class="mt-4 font-sans">
                    <label>Kárdex del estudiante</label>
                    <x-subir-kardex id="kardex" name="kardex">
                        Sube tu Kardex (PDF)
                    </x-subir-kardex>
                </div>
            </form>