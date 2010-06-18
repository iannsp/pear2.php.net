<?php

switch ($context->stability['release']) {
case 'alpha':
    $statusClass = 'package-alpha';
    break;
case 'beta':
    $statusClass = 'package-beta';
    break;
default:
    $statusClass = 'package-stable';
    break;
}

$releaseDateISO = $context->date . 'T' . $context->time;
$releaseDate    = date('F j, Y', strtotime($releaseDateISO));

$licenseURI   = \PEAR2Web\License::getLink($context->license['name']);
$licenseClass = \PEAR2Web\License::isValid($context->license['name']) ?
    'package-license-good' : 'package-license-bad';

?>

<table class="package-details">
    <tbody>
        <tr>
            <th>Status:</th>
            <td>
                <?php echo $context->version['release']; ?>
                <span class="<?php echo $statusClass; ?>"><?php echo $context->stability['release']; ?></span>,
                released on <abbr class="date" title="<?php echo $releaseDateISO; ?>"><?php echo $releaseDate; ?></abbr>
            </td>
        </tr>
        <tr>
            <th>License:</th>
            <td>
<?php

if ($licenseURI) {
    echo '                ';
    echo '<a href="' . $licenseURI . '" class="' . $licenseClass . '">';
}
echo $context->license['name'];
if ($licenseURI) {
    echo '</a>' . "\n";
}

?>
            </td>
        </tr>
        <!-- tr>
            <th>Bugs:</th>
            <td></td>
        </tr -->

<?php if ($parent->parent->context->options['view'] === 'package') { ?>
        <tr>
            <th>Maintainers:</th>
            <td>
<?php

if (count($context->maintainer) === 0) {
    echo '<span class="package-unmaintained">none</span>';
} else {
    echo '                <ul class="package-maintainers">' . "\n";
    foreach ($context->maintainer as $handle=>$maintainer) {
        echo '                    <li>';
        echo '<a href="#">' . $maintainer->name . '</a>';
        echo ' [' . $handle .'] (' . $maintainer->role . ')';
        echo '</li>' . "\n";
    }
    echo '                </ul>' . "\n";
}

?>
            </td>
        </tr>
<?php } else { ?>
        <tr>
            <th>Maintained:</th>
            <td>
<?php

if (count($context->maintainer) === 0) {
    echo '<span class="package-unmaintained">no</span>';
} else {
    echo '<span class="package-maintained">yes</span>';
}

?>
            </td>
        </tr>
<?php } ?>

    </tbody>
</table>
