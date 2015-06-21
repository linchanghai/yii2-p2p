<?php
/**
 * Created by PhpStorm.
 * User: LCH
 * Date: 2015/6/21
 * Time: 10:38
 */

namespace p2p\project\models;

use kiwi\Kiwi;

/**
 * Class ProjectTrait
 *
 * @property \p2p\project\models\Project $project
 * @property \p2p\project\models\ProjectDetails $projectDetails
 * @property \p2p\project\models\ProjectLegalOpinion $projectLegalOpinion
 * @property \p2p\project\models\ProjectMaterial $projectMaterial
 *
 * @author 1079140464@qq.com
 * @package p2p\project\models
 */
trait ProjectTrait {
    public function getProject()
    {
        return $this->hasOne(Kiwi::getProjectClass(), ['project_id' => 'project_id']);
    }

    public function getProjectDetails()
    {
        return $this->hasOne(Kiwi::getProjectDetailsClass(), ['project_id' => 'project_id']);
    }

    public function getProjectLegalOpinion()
    {
        return $this->hasOne(Kiwi::getProjectLegalOpinionClass(), ['project_id' => 'project_id']);
    }

    public function getProjectMaterial()
    {
        return $this->hasOne(Kiwi::getProjectMaterialClass(), ['project_id' => 'project_id']);
    }
}