<?php

namespace App\Models\Record\Traits\Attribute;

/**
 * Trait TranslateAttribute.
 */
trait TranslateAttribute
{ 
    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.record.translate.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.record.translate.edit', $this).'" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.record.translate.destroy', $this).'"
			 data-method="delete"
			 data-trans-button-cancel="'.__('buttons.general.cancel').'"
			 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
			 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
			 class="dropdown-item">Delete</a> ';
    }

    public function getStatusButtonAttribute(){
        switch($this->status){
            case 0 : 
                return '<a href="'.route('admin.record.translate.mark', [$this, 1]).'" class="dropdown-item bg-success">Activate</a>';
            case 1 :
                return '<a href="'.route('admin.record.translate.mark', [$this, 0]).'" class="dropdown-item bg-warning">Deactivate</a>';
            default :
                return '';
        }
        
    }

    public function getAssignButtonAttribute(){
        return '<a href="'.route('admin.record.translate.assign_branch', $this).'" class="dropdown-item">Assign Branch</a>';
    
        // return '<button data-toggle="modal" data-target="#branchModal" class="dropdown-item btn-assign" data-id="'. $this->id .'">Assign Branch</button>';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
		  '.$this->show_button.'
		  '.$this->edit_button.'

		  <div class="btn-group btn-group-sm" role="group">
			<button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  '.__('labels.general.more').'
			</button>
			<div class="dropdown-menu" aria-labelledby="userActions"> 
            '.$this->delete_button.'
            '.$this->status_button.'
			</div>
		  </div>
		</div>';

        // return '<div class="btn-group btn-group-sm" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
		// 	  '.$this->show_button.'
		// 	  '.$this->edit_button.'
		// 	  '.$this->delete_button.'
		// 	  '.$this->status_button.'
		// 	</div>';
    }

    /**
     * @return string
     */
    public function getStatusLabelAttribute(){
        return $this->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Not Active</span>';
    }
    
}
