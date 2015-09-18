<br clear="all" />

<h1>Options</h1>



<form method="POST" action="">
    <input type="hidden" name="action" value="set"/>
    
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label for="options[center][address]">Address</label>
                </th>
                <td>
                    <input name="options[center][address]" type="text" value="<?= $center->address ?>" class="regular-text">
                </td>
            </tr>
        <tbody>
    </table>
    
    <div class="tablenav bottom">
		<button class="button button-primary">Save</button>
	</div>
</form>
