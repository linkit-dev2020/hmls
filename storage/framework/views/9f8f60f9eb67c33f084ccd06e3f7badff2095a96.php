<?php $__currentLoopData = $students->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="">
        <td><?php echo e($student->username); ?></td>
        <td class="operations">
            <?php if($student->active): ?>
                <form action="<?php echo e(route('users.deactivate', $student)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($student->id+1); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($student->id+1); ?>').click();" >
                        <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                </form>
            <?php else: ?>
                <form action="<?php echo e(route('users.activate', $student)); ?>" method="POST" id="activateForm">
                    <?php echo csrf_field(); ?>

                    <button id="<?php echo e($student->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#<?php echo e($student->id); ?>').click();" >
                        <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                </form>
            <?php endif; ?>
        </td>
        <td><?php echo e($student->tc); ?></td>

        <td><?php echo e($student->phone); ?></td>
        <td><?php echo e($student->created_at); ?></td>
        <td>
            <div class="operations show">
                <a href="<?php echo e(route('users.show', $student)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
            </div>
        </td>
        <td>
            <div class="operations update">
                <a href="<?php echo e(route('users.edit', $student)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
            </div>
        </td>
        <td>
            <div class="operations delete">
                <form action="<?php echo e(route('users.destroy',['user' => $student->id])); ?>" method="POST" id="deleteForm">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <button id="del<?php echo e($student->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#del<?php echo e($student->id); ?>').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                    </a>
                </form>
            </div>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xamppp\htdocs\laravel5.8\blog\resources\views/admin/users/studbyclass.blade.php ENDPATH**/ ?>