<?php
/**
 * @package     Mautic
 * @copyright   2015 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<?php if (!empty($filters)) : ?>
    <div class="form-group">
        <?php
        foreach ($filters as $filterName => $filter):

        $filterName = $view['translator']->trans($filterName);
        $attr = array(
                'id="' . $filterName . '"',
                'name="' . $filterName . '"'
            );
        if (!empty($filter['multiple'])) {
            $attr[] = 'multiple';
        }

        if (!empty($filter['placeholder'])) {
            $attr[] = 'data-placeholder="' . $filter['placeholder'] . '"';
        } else {
            $attr[] = 'data-placeholder="' . $view['translator']->trans('mautic.core.list.filter') . '"';
        }

        if (!empty($filter['onchange'])) {
            $attr[] = 'onchange="' . $filter['onchange'] . '"';
        } else {
            $attr[] = 'data-toggle="listfilter"';
            $attr[] = 'data-target="' . (!empty($target) ? $target : '.page-list') . '"';
        }

        $attr[] = 'data-tmpl="' . (!empty($tmpl) ? $tmpl : 'list') . '"';

        if (!empty($filter['prefix-exceptions'])) {
            $attr[] = 'data-prefix-exceptions="' . implode(',', $filter['prefix-exceptions']) . '"';
        }
        ?>

            <?php if (isset($filter['groups'])): ?>
            <select <?php echo implode(' ', $attr); ?>>
            <?php foreach ($filter['groups'] as $groupLabel => $groupFilter): ?>
            <optgroup label="<?php echo $view['translator']->trans($groupLabel); ?>"<?php if (isset($groupFilter['prefix'])) echo ' data-prefix="' . $groupFilter['prefix'] . '"'; ?>>
                <?php if (isset($groupFilter['options'])): ?>
                <?php foreach ($groupFilter['options'] as $label => $value):
                    if (is_array($value)):
                        $label = (!empty($value['label'])) ? $value['label'] : (!empty($value['title']) ? $value['title'] : $value['name']);
                        $value = (!empty($value['value'])) ? $value['value'] : $value['id'];
                    endif;

                    $selected = (isset($groupFilter['values']) && in_array($value, $groupFilter['values'])) ? ' selected' : '';

                    if (isset($groupFilter['prefix']))
                        $value = $groupFilter['prefix'] . ':' . $value;

                ?>
                <option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </optgroup>
            <?php endforeach; ?>

            <?php elseif (isset($filter['options'])): ?>
            <?php foreach ($filter['options'] as $label => $value):
                if (is_array($value)):
                    $label = (!empty($value['label'])) ? $value['label'] : (!empty($value['title']) ? $value['title'] : $value['name']);
                    $value = (!empty($value['value'])) ? $value['value'] : $value['id'];
                endif;

                $selected = (isset($groupFilter['values']) && in_array($value, $groupFilter['values'])) ? ' selected' : '';
                ?>
                <option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $label; ?></option>
            <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <?php endforeach; ?>
    </div>
<?php endif; ?>