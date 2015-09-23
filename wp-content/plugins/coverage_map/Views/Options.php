<div class="wrap">
    <h1>Options</h1>
    
    <h2 class="nav-tab-wrapper">
        <a href="#" class="nav-tab <?= $activeTab == "map" ? "nav-tab-active" : "" ?>" data-tab="map">Map</a>
        <a href="#" class="nav-tab <?= $activeTab == "points" ? "nav-tab-active" : "" ?>" data-tab="points">Points</a>
        <a href="#" class="nav-tab <?= $activeTab == "zones" ? "nav-tab-active" : "" ?>" data-tab="zones">Zones</a>
    </h2>
    
    
    <form method="POST" action="">
        <input type="hidden" name="action" value="set">
        
        <div class="tabs-wrapper">
            
            <!-- Tab 'map'-->
            <div class="tab-content" data-tab="map" <?= $activeTab == "map" ? "" : "style='display:none'" ?>>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="options[map][address]">Center Address</label>
                            </th>
                            <td>
                                <input id="center-address" name="options[map][address]" type="text" value="<?= $map->address ?>" class="regular-text address">
                                <input data-address-id="center-address" name="options[map][longitude]" class="longitude" type="hidden" value="<?= $map->longitude ?>">
                                <input data-address-id="center-address" name="options[map][latitude]" class="latitude" type="hidden" value="<?= $map->latitude ?>">
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="options[map][zoom]">Zoom</label>
                            </th>
                            <td>
                                <input name="options[map][zoom]" type="text" value="<?= $map->zoom ?>" class="short-text">
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="options[map][width]">Width</label>
                            </th>
                            <td>
                                <input name="options[map][width]" type="text" value="<?= $map->width ?>" class="short-text">
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="options[map][height]">Height</label>
                            </th>
                            <td>
                                <input name="options[map][height]" type="text" value="<?= $map->height ?>" class="short-text">
                            </td>
                        </tr>
                    </tbody>
                </table>            
            </div>
            
            
            
            <!-- Tab 'points'-->
            <div class="tab-content" data-tab="points" <?= $activeTab == "points" ? "" : "style='display:none'" ?>>
                <br>
                <a href="#" class="page-title-action new-point-toggle" data-state="hidden">Add point</a>
                
                <!-- 'New Point' block -->
                <div id="new-point" style="display: none">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="options[points][<?= count($points)+1 ?>][address]">Address</label>
                                </th>
                                <td>
                                    <input id="new-point-address" name="options[points][<?= count($points)+1 ?>][address]" type="text" class="large-text address">
                                    <input data-address-id="new-point-address" name="options[points][<?= count($points)+1 ?>][longitude]" type="hidden" class="longitude">
                                    <input data-address-id="new-point-address" name="options[points][<?= count($points)+1 ?>][latitude]" type="hidden" class="latitude">
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="options[points][<?= count($points)+1 ?>][title]">Title</label>
                                </th>
                                <td>
                                    <input name="options[points][<?= count($points)+1 ?>][title]" type="text" class="large-text">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="options[points][<?= count($points)+1 ?>][title]">Description</label>
                                </th>
                                <td>
                                    <textarea name="options[points][<?= count($points)+1 ?>][description]" rows="10" cols="50" class="large-text code"></textarea>
                                </td>
                            </tr>                     
                        </tbody>
                    </table>
                </div>
                
        
                <!-- List of existing points -->
                <div id="points">                    
                    <table class="form-table">
                        <tbody>
                            <? foreach ($points as $i=>$point) { ?>
                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <a href="#" class="remove-point button" data-point="<?= $i ?>">Delete</a>
                                    </th>
                                </tr>                                
                                
                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[points][<?= $i ?>][address]">Address</label>
                                    </th>
                                    <td>
                                        <input id="point-address-<?= $i ?>" name="options[points][<?= $i ?>][address]" type="text" class="large-text address" value="<?= $point->address ?>">
                                        <input data-address-id="point-address-<?= $i ?>" name="options[points][<?= $i ?>][longitude]" type="hidden" class="longitude" value="<?= $point->longitude ?>">
                                        <input data-address-id="point-address-<?= $i ?>" name="options[points][<?= $i ?>][latitude]" type="hidden" class="latitude" value="<?= $point->latitude ?>">
                                    </td>
                                </tr>
                                
                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[points][<?= $i ?>][title]">Title</label>
                                    </th>
                                    <td>
                                        <input name="options[points][<?= $i ?>][title]" type="text" class="large-text" value="<?= esc_attr($point->title) ?>">
                                    </td>
                                </tr>

                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[points][<?= $i ?>][title]">Description</label>
                                    </th>
                                    <td>
                                        <textarea name="options[points][<?= $i ?>][description]" rows="10" cols="50" class="large-text code"><?= (esc_textarea($point->description)) ?></textarea>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            
            <!-- Tab 'zones'-->
            <div class="tab-content" data-tab="zones" <?= $activeTab == "zones" ? "" : "style='display:none'" ?>>
                <br>
                <a href="#" class="page-title-action new-zone-toggle" data-state="hidden">Add zone</a>
                
                <!-- 'New Zone' block -->
                <div id="new-zone" style="display: none">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="options[zones][<?= count($zones)+1 ?>][speed]">Speed</label>
                                </th>
                                <td>
                                    <input name="options[zones][<?= count($zones)+1 ?>][speed]" type="text" class="short-text">
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="options[zones][<?= count($zones)+1 ?>][radius]">Radius</label>
                                </th>
                                <td>
                                    <input name="options[zones][<?= count($zones)+1 ?>][radius]" type="text" class="short-text"> meters
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="options[zones][<?= count($zones)+1 ?>][color]">Color</label>
                                </th>
                                <td>
                                    <input name="options[zones][<?= count($zones)+1 ?>][color]" type="text" class="short-text color-picker">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
        
                <!-- List of existing zones -->
                <div id="zones">                    
                    <table class="form-table">
                        <tbody>
                            <? foreach ($zones as $i=>$zone) { ?>
                                <tr data-zone="<?= $i ?>">
                                    <th scope="row">
                                        <a href="#" class="remove-zone button" data-zone="<?= $i ?>">Delete</a>
                                    </th>
                                </tr> 
                                
                                <tr>
                                    <th scope="row">
                                        <label for="options[zones][<?= $i ?>][speed]">Speed</label>
                                    </th>
                                    <td>
                                        <input name="options[zones][<?= $i ?>][speed]" type="text" class="short-text" value="<?= $zone->speed ?>">
                                    </td>
                                </tr>
                                
                                <tr data-zone="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[zones][<?= $i ?>][radius]">Radius</label>
                                    </th>
                                    <td>
                                        <input name="options[zones][<?= $i ?>][radius]" type="text" class="short-text" value="<?= $zone->radius ?>"> meters
                                    </td>
                                </tr>
                                
                                <tr data-zone="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[zones][<?= $i ?>][color]">Color</label>
                                    </th>
                                    <td>
                                        <input name="options[zones][<?= $i ?>][color]" type="text" class="short-text color-picker" value="<?= $zone->color ?>">
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Map -->        
        <?= \CoverageMap\Libs\Helper::render(__DIR__ . "/Map.php", $vars); ?>

        <input type="submit" class="button-primary" value="Save changes">
    </form>
</div>
