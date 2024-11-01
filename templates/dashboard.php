<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$forms = weavely_get_forms($current_team_data['id'] ,$api_key);
?>

<?php if ($forms){ ?>
    <div class="info-panel">
        <span>
        <b>Did you know?</b> You can add <b>width</b> and <b>height</b> attributes to the shortcode. For example, use [weavely_form id="e36c20f9-802f-453f-453f-a72e-f98609e643e0" width="100%" height="350px"] to specify the form dimensions.
        </span>
        </div>
    <table>
        <tr>
            <th align="left">Form</th>
            <th align="left">Submissions</th>
            <th>Shortcode</th>
        </tr>
        <?php if (!empty($forms)): ?>
            <?php foreach ($forms as $form): ?>
                <tr>
                    <td><b><?php echo esc_html($form['name']); ?></b></td>
                    <td class="submissions">
                        <a href="<?php echo esc_url("https://api.weavely.ai/forms/{$form['id']}/data") ?>" target="_blank">
                            <img src="<?php echo esc_url(@$table_icon_url) ?>" class="table-icon" alt=""/> Submissions
                        </a>
                    </td>
                    <td class="shortcode">[weavely_form id="<?php echo esc_html($form['id']); ?>"]</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No forms found</td>
            </tr>
        <?php endif; ?>
    </table>
<?php } else { ?>

    <div>
        <p>Looks like you haven't created any forms yet!</p>
        <p>Get started by designing your first form using the <a href="https://www.figma.com/community/plugin/1255122665773297640/weavely-figma-to-web-forms" target="_blank">Weavely plugin</a> in Figma.
        <p>Create a custom design in Figma, then effortlessly publish and embed it into your WordPress site.
            </br/>
            Your published forms will show up here.
        </p>
    </div>

<?php }; ?>