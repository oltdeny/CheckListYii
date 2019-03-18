<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $look = $auth->createPermission('look');
        $look->description = 'Look at users and check-lists';
        $auth->add($look);

        $edit = $auth->createPermission('edit');
        $edit->description = 'Edit count of possible check-lists for user';
        $auth->add($edit);

        $block = $auth->createPermission('block');
        $block->description = 'Block and unblock users';
        $auth->add($block);

        $permit = $auth->createPermission('permit');
        $permit->description = 'Give permissions to user';
        $auth->add($permit);

        $looker = $auth->createRole('looker');
        $auth->add($looker);
        $auth->addChild($looker, $look);

        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $edit);
        $auth->addChild($editor, $look);

        $blocker = $auth->createRole('blocker');
        $auth->add($blocker);
        $auth->addChild($blocker, $block);
        $auth->addChild($blocker, $look);

        $permitor = $auth->createRole('permitor');
        $auth->add($permitor);
        $auth->addChild($permitor, $permit);
        $auth->addChild($permitor, $look);
    }
}