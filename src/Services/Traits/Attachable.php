<?php

namespace Rangka\Quickbooks\Services\Traits;

use Rangka\Quickbooks\Services\Attachable as AttachableService;

trait Attachable {
    /**
     * Attach attachments to an Entity.
     *
     * @param int     $id              ID of entity.
     * @param array   $file            Array of files each consists of:
     *                                   - 'path' - Path to file. Required.
     *                                   - 'name' - File name. Optional.
     *                                   - 'type' - File type. Optional.
     * @param boolean $includeOnSend   Attach to Email. Optional.
     * 
     * @return \Rangka\Quickbooks\Builders\ItemizedItem
     */
    public function attach($id, $files, $includeOnSend = null) {
        $service = new AttachableService;
        $builder = $service->getBuilder();

        foreach ($files as $file) {
            $builder->addFile($file, [[
                'entity'        => $this->getEntityName(), 
                'id'            => $id, 
                'includeOnSend' => $includeOnSend,
            ]]);
        }

        return $builder->upload();
    }
}