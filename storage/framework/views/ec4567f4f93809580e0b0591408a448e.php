<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            <?php if($paginator->onFirstPage()): ?>
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed leading-5 rounded-lg">
                    Anterior
                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 leading-5 rounded-lg hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Anterior
                </a>
            <?php endif; ?>

            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold text-gray-700 bg-white border border-gray-200 leading-5 rounded-lg hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Siguiente
                </a>
            <?php else: ?>
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed leading-5 rounded-lg">
                    Siguiente
                </span>
            <?php endif; ?>
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-600 leading-5">
                    Mostrando
                    <span class="font-semibold text-gray-900"><?php echo e($paginator->firstItem()); ?></span>
                    -
                    <span class="font-semibold text-gray-900"><?php echo e($paginator->lastItem()); ?></span>
                    de
                    <span class="font-semibold text-gray-900"><?php echo e($paginator->total()); ?></span>
                    resultados
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-lg shadow-sm space-x-1">
                    
                    <?php if($paginator->onFirstPage()): ?>
                        <span aria-disabled="true" aria-label="Previous">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed rounded-l-lg leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-l-lg leading-5 hover:bg-gray-50 hover:border-gray-300 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Previous">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    <?php endif; ?>

                    
                    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if(is_string($element)): ?>
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 cursor-default leading-5"><?php echo e($element); ?></span>
                            </span>
                        <?php endif; ?>

                        
                        <?php if(is_array($element)): ?>
                            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($page == $paginator->currentPage()): ?>
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-indigo-600 cursor-default leading-5 shadow-sm"><?php echo e($page); ?></span>
                                    </span>
                                <?php else: ?>
                                    <a href="<?php echo e($url); ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 leading-5 hover:bg-gray-50 hover:border-gray-300 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Go to page <?php echo e($page); ?>">
                                        <?php echo e($page); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($paginator->hasMorePages()): ?>
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-r-lg leading-5 hover:bg-gray-50 hover:border-gray-300 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Next">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <span aria-disabled="true" aria-label="Next">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed rounded-r-lg leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </nav>
<?php endif; ?>
<?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>