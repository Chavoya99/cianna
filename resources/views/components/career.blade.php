<!-- resources/views/components/career.blade.php -->

<div>
    <x-custom-label>Carrera</x-custom-label>
    <x-custom-select id="carrera" name="carrera" class="text-sm">
        <option @selected(old('carrera') == 'ing_alim_biot' || (isset($usuario) && $usuario->carrera == 'ing_alim_biot')) value="ing_alim_biot">Ing. en Alimentos y Biotecnología</option>
        <option @selected(old('carrera') == 'ing_biom' || (isset($usuario) && $usuario->carrera == 'ing_biom')) value="ing_biom">Ing. Biómedica</option>
        <option @selected(old('carrera') == 'ing_civi' || (isset($usuario) && $usuario->carrera == 'ing_civi')) value="ing_civi">Ing. Civil</option>
        <option @selected(old('carrera') == 'ing_comp' || (isset($usuario) && $usuario->carrera == "ing_comp")) value="ing_comp">Ing. Computación</option>
        <option @selected(old('carrera') == 'ing_com_elec' || (isset($usuario) && $usuario->carrera == 'ing_com_elec')) value="ing_com_elec">Ing. en Comunicaciones y Eléctrónica</option>
        <option @selected(old('carrera') == 'ing_log_trans' || (isset($usuario) && $usuario->carrera == 'ing_log_trans')) value="ing_log_trans">Ing. en Logística y Transporte</option>
        <option @selected(old('carrera') == 'ing_topo' || (isset($usuario) && $usuario->carrera == 'ing_topo')) value="ing_topo">Ing. en Topografía Geomática</option>
        <option @selected(old('carrera') == 'ing_foto' || (isset($usuario) && $usuario->carrera == 'ing_foto')) value="ing_foto">Ing. Fotónica</option>
        <option @selected(old('carrera') == 'ing_indu' || (isset($usuario) && $usuario->carrera == 'ing_indu')) value="ing_indu">Ing. Industrial</option>
        <option @selected(old('carrera') == 'ing_info' || (isset($usuario) && $usuario->carrera == 'ing_info')) value="ing_info">Ing. Informática</option>
        <option @selected(old('carrera') == 'ing_meca' || (isset($usuario) && $usuario->carrera == 'ing_meca')) value="ing_meca">Ing. Mecánica Eléctrica</option>
        <option @selected(old('carrera') == 'iing_quim' || (isset($usuario) && $usuario->carrera == 'ing_quim')) value="ing_quim">Ing. Química</option>
        <option @selected(old('carrera') == 'ing_robo' || (isset($usuario) && $usuario->carrera == 'ing_robo')) value="ing_robo">Ing. Robótica</option>
        <option @selected(old('carrera') == 'lic_cien_mate' || (isset($usuario) && $usuario->carrera == 'lic_cien_mate')) value="lic_cien_mate">Lic. en Ciencia de Materiales</option>
        <option @selected(old('carrera') == 'lic_fis' || (isset($usuario) && $usuario->carrera == 'lic_fis')) value="lic_fis">Lic. en Física</option>
        <option @selected(old('carrera') == 'lic_mate' || (isset($usuario) && $usuario->carrera == 'lic_mate')) value="lic_mate">Lic. en Matemáticas</option>
        <option @selected(old('carrera') == 'lic_quim' || (isset($usuario) && $usuario->carrera == 'lic_quim')) value="lic_quim">Lic. en Química</option>
        <option @selected(old('carrera') == 'lic_qfb' || (isset($usuario) && $usuario->carrera == 'lic_qfb')) value="lic_qfb">Lic. en Químico Farmacéutico Biólogo</option>
    </x-custom-select>
</div>