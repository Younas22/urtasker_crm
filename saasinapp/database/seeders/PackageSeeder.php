<?php

namespace Database\Seeders;

use App\Models\Landlord\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Basic',
                'is_free_trial' => true,
                'monthly_fee' => 19,
                'yearly_fee' => 190,
                'number_of_user_account' => 100,
                'number_of_employee' => 200,
                'features' => 'user,details-employee,customize-setting,role,general-setting,mail-setting,access-variable_type,access-variable_method,access-language,company,department,designation,location,timesheet,office_shift',
                'permissions' => '[{"id":1,"name":"user","parent":null,"treeview":1,"guard_name":"web"},{"id":2,"name":"view-user","parent":"user","treeview":1,"guard_name":"web"},{"id":3,"name":"edit-user","parent":"user","treeview":1,"guard_name":"web"},{"id":4,"name":"delete-user","parent":"user","treeview":1,"guard_name":"web"},{"id":5,"name":"details-employee","parent":null,"treeview":1,"guard_name":"web"},{"id":6,"name":"view-details-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":7,"name":"store-details-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":8,"name":"modify-details-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":9,"name":"import-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":10,"name":"customize-setting","parent":null,"treeview":1,"guard_name":"web"},{"id":11,"name":"role","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":12,"name":"view-role","parent":"role","treeview":1,"guard_name":"web"},{"id":13,"name":"store-role","parent":"role","treeview":1,"guard_name":"web"},{"id":14,"name":"edit-role","parent":"role","treeview":1,"guard_name":"web"},{"id":15,"name":"delete-role","parent":"role","treeview":1,"guard_name":"web"},{"id":16,"name":"set-permission","parent":"role","treeview":1,"guard_name":"web"},{"id":17,"name":"general-setting","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":18,"name":"view-general-setting","parent":"general-setting","treeview":1,"guard_name":"web"},{"id":19,"name":"store-general-setting","parent":"general-setting","treeview":1,"guard_name":"web"},{"id":20,"name":"mail-setting","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":21,"name":"view-mail-setting","parent":"mail-setting","treeview":1,"guard_name":"web"},{"id":22,"name":"store-mail-setting","parent":"mail-setting","treeview":1,"guard_name":"web"},{"id":23,"name":"access-variable_type","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":24,"name":"access-variable_method","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":25,"name":"access-language","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":26,"name":"company","parent":null,"treeview":1,"guard_name":"web"},{"id":27,"name":"view-company","parent":"company","treeview":1,"guard_name":"web"},{"id":28,"name":"store-company","parent":"company","treeview":1,"guard_name":"web"},{"id":29,"name":"edit-company","parent":"company","treeview":1,"guard_name":"web"},{"id":30,"name":"delete-company","parent":"company","treeview":1,"guard_name":"web"},{"id":31,"name":"department","parent":null,"treeview":1,"guard_name":"web"},{"id":32,"name":"view-department","parent":"department","treeview":1,"guard_name":"web"},{"id":33,"name":"store-department","parent":"department","treeview":1,"guard_name":"web"},{"id":34,"name":"edit-department","parent":"department","treeview":1,"guard_name":"web"},{"id":35,"name":"delete-department","parent":"department","treeview":1,"guard_name":"web"},{"id":36,"name":"designation","parent":null,"treeview":1,"guard_name":"web"},{"id":37,"name":"view-designation","parent":"designation","treeview":1,"guard_name":"web"},{"id":38,"name":"store-designation","parent":"designation","treeview":1,"guard_name":"web"},{"id":39,"name":"edit-designation","parent":"designation","treeview":1,"guard_name":"web"},{"id":40,"name":"delete-designation","parent":"designation","treeview":1,"guard_name":"web"},{"id":41,"name":"location","parent":null,"treeview":1,"guard_name":"web"},{"id":42,"name":"view-location","parent":"location","treeview":1,"guard_name":"web"},{"id":43,"name":"store-location","parent":"location","treeview":1,"guard_name":"web"},{"id":44,"name":"edit-location","parent":"location","treeview":1,"guard_name":"web"},{"id":45,"name":"delete-location","parent":"location","treeview":1,"guard_name":"web"},{"id":88,"name":"timesheet","parent":null,"treeview":2,"guard_name":"web"},{"id":94,"name":"office_shift","parent":"timesheet","treeview":2,"guard_name":"web"},{"id":95,"name":"view-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":96,"name":"store-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":97,"name":"edit-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":98,"name":"delete-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":277,"name":"store-user","parent":"user","treeview":1,"guard_name":"web"},{"id":278,"name":"last-login-user","parent":"user","treeview":1,"guard_name":"web"},{"id":279,"name":"role-access-user","parent":"user","treeview":1,"guard_name":"web"}]',
                'permission_names' => 'user,view-user,edit-user,delete-user,details-employee,view-details-employee,store-details-employee,modify-details-employee,import-employee,customize-setting,role,view-role,store-role,edit-role,delete-role,set-permission,general-setting,view-general-setting,store-general-setting,mail-setting,view-mail-setting,store-mail-setting,access-variable_type,access-variable_method,access-language,company,view-company,store-company,edit-company,delete-company,department,view-department,store-department,edit-department,delete-department,designation,view-designation,store-designation,edit-designation,delete-designation,location,view-location,store-location,edit-location,delete-location,timesheet,office_shift,view-office_shift,store-office_shift,edit-office_shift,delete-office_shift,store-user,last-login-user,role-access-user',
                'permission_ids' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,88,94,95,96,97,98,277,278,279',
                'is_active' => true,
                'position' => 1
            ],
            [
                'name' => 'Standard',
                'is_free_trial' => true,
                'monthly_fee' => 22,
                'yearly_fee' => 220,
                'number_of_user_account' => 100,
                'number_of_employee' => 200,
                'features' => 'user,details-employee,customize-setting,role,general-setting,mail-setting,access-variable_type,access-variable_method,access-language,core_hr,view-calendar,promotion,award,transfer,travel,resignation,complaint,warning,termination,timesheet,office_shift,project-management,project,task,client,invoice',
                'permissions' => '[{"id":1,"name":"user","parent":null,"treeview":1,"guard_name":"web"},{"id":2,"name":"view-user","parent":"user","treeview":1,"guard_name":"web"},{"id":3,"name":"edit-user","parent":"user","treeview":1,"guard_name":"web"},{"id":4,"name":"delete-user","parent":"user","treeview":1,"guard_name":"web"},{"id":5,"name":"details-employee","parent":null,"treeview":1,"guard_name":"web"},{"id":6,"name":"view-details-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":7,"name":"store-details-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":8,"name":"modify-details-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":9,"name":"import-employee","parent":"details-employee","treeview":1,"guard_name":"web"},{"id":10,"name":"customize-setting","parent":null,"treeview":1,"guard_name":"web"},{"id":11,"name":"role","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":12,"name":"view-role","parent":"role","treeview":1,"guard_name":"web"},{"id":13,"name":"store-role","parent":"role","treeview":1,"guard_name":"web"},{"id":14,"name":"edit-role","parent":"role","treeview":1,"guard_name":"web"},{"id":15,"name":"delete-role","parent":"role","treeview":1,"guard_name":"web"},{"id":16,"name":"set-permission","parent":"role","treeview":1,"guard_name":"web"},{"id":17,"name":"general-setting","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":18,"name":"view-general-setting","parent":"general-setting","treeview":1,"guard_name":"web"},{"id":19,"name":"store-general-setting","parent":"general-setting","treeview":1,"guard_name":"web"},{"id":20,"name":"mail-setting","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":21,"name":"view-mail-setting","parent":"mail-setting","treeview":1,"guard_name":"web"},{"id":22,"name":"store-mail-setting","parent":"mail-setting","treeview":1,"guard_name":"web"},{"id":23,"name":"access-variable_type","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":24,"name":"access-variable_method","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":25,"name":"access-language","parent":"customize-setting","treeview":1,"guard_name":"web"},{"id":46,"name":"core_hr","parent":null,"treeview":1,"guard_name":"web"},{"id":47,"name":"view-calendar","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":48,"name":"promotion","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":49,"name":"view-promotion","parent":"promotion","treeview":1,"guard_name":"web"},{"id":50,"name":"store-promotion","parent":"promotion","treeview":1,"guard_name":"web"},{"id":51,"name":"edit-promotion","parent":"promotion","treeview":1,"guard_name":"web"},{"id":52,"name":"delete-promotion","parent":"promotion","treeview":1,"guard_name":"web"},{"id":53,"name":"award","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":54,"name":"view-award","parent":"award","treeview":1,"guard_name":"web"},{"id":55,"name":"store-award","parent":"award","treeview":1,"guard_name":"web"},{"id":56,"name":"edit-award","parent":"award","treeview":1,"guard_name":"web"},{"id":57,"name":"delete-award","parent":"award","treeview":1,"guard_name":"web"},{"id":58,"name":"transfer","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":59,"name":"view-transfer","parent":"transfer","treeview":1,"guard_name":"web"},{"id":60,"name":"store-transfer","parent":"transfer","treeview":1,"guard_name":"web"},{"id":61,"name":"edit-transfer","parent":"transfer","treeview":1,"guard_name":"web"},{"id":62,"name":"delete-transfer","parent":"transfer","treeview":1,"guard_name":"web"},{"id":63,"name":"travel","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":64,"name":"view-travel","parent":"travel","treeview":1,"guard_name":"web"},{"id":65,"name":"store-travel","parent":"travel","treeview":1,"guard_name":"web"},{"id":66,"name":"edit-travel","parent":"travel","treeview":1,"guard_name":"web"},{"id":67,"name":"delete-travel","parent":"travel","treeview":1,"guard_name":"web"},{"id":68,"name":"resignation","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":69,"name":"view-resignation","parent":"resignation","treeview":1,"guard_name":"web"},{"id":70,"name":"store-resignation","parent":"resignation","treeview":1,"guard_name":"web"},{"id":71,"name":"edit-resignation","parent":"resignation","treeview":1,"guard_name":"web"},{"id":72,"name":"delete-resignation","parent":"resignation","treeview":1,"guard_name":"web"},{"id":73,"name":"complaint","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":74,"name":"view-complaint","parent":"complaint","treeview":1,"guard_name":"web"},{"id":75,"name":"store-complaint","parent":"complaint","treeview":1,"guard_name":"web"},{"id":76,"name":"edit-complaint","parent":"complaint","treeview":1,"guard_name":"web"},{"id":77,"name":"delete-complaint","parent":"complaint","treeview":1,"guard_name":"web"},{"id":78,"name":"warning","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":79,"name":"view-warning","parent":"warning","treeview":1,"guard_name":"web"},{"id":80,"name":"store-warning","parent":"warning","treeview":1,"guard_name":"web"},{"id":81,"name":"edit-warning","parent":"warning","treeview":1,"guard_name":"web"},{"id":82,"name":"delete-warning","parent":"warning","treeview":1,"guard_name":"web"},{"id":83,"name":"termination","parent":"core_hr","treeview":1,"guard_name":"web"},{"id":84,"name":"view-termination","parent":"termination","treeview":1,"guard_name":"web"},{"id":85,"name":"store-termination","parent":"termination","treeview":1,"guard_name":"web"},{"id":86,"name":"edit-termination","parent":"termination","treeview":1,"guard_name":"web"},{"id":87,"name":"delete-termination","parent":"termination","treeview":1,"guard_name":"web"},{"id":88,"name":"timesheet","parent":null,"treeview":2,"guard_name":"web"},{"id":94,"name":"office_shift","parent":"timesheet","treeview":2,"guard_name":"web"},{"id":95,"name":"view-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":96,"name":"store-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":97,"name":"edit-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":98,"name":"delete-office_shift","parent":"office_shift","treeview":2,"guard_name":"web"},{"id":145,"name":"project-management","parent":null,"treeview":2,"guard_name":"web"},{"id":146,"name":"project","parent":"project-management","treeview":2,"guard_name":"web"},{"id":147,"name":"view-project","parent":"project","treeview":2,"guard_name":"web"},{"id":148,"name":"store-project","parent":"project","treeview":2,"guard_name":"web"},{"id":149,"name":"edit-project","parent":"project","treeview":2,"guard_name":"web"},{"id":150,"name":"delete-project","parent":"project","treeview":2,"guard_name":"web"},{"id":151,"name":"assign-project","parent":"project","treeview":2,"guard_name":"web"},{"id":152,"name":"task","parent":"project-management","treeview":2,"guard_name":"web"},{"id":153,"name":"view-task","parent":"task","treeview":2,"guard_name":"web"},{"id":154,"name":"store-task","parent":"task","treeview":2,"guard_name":"web"},{"id":155,"name":"edit-task","parent":"task","treeview":2,"guard_name":"web"},{"id":156,"name":"delete-task","parent":"task","treeview":2,"guard_name":"web"},{"id":157,"name":"assign-task","parent":"task","treeview":2,"guard_name":"web"},{"id":158,"name":"client","parent":"project-management","treeview":2,"guard_name":"web"},{"id":159,"name":"view-client","parent":"client","treeview":2,"guard_name":"web"},{"id":160,"name":"store-client","parent":"client","treeview":2,"guard_name":"web"},{"id":161,"name":"edit-client","parent":"client","treeview":2,"guard_name":"web"},{"id":162,"name":"delete-client","parent":"client","treeview":2,"guard_name":"web"},{"id":163,"name":"invoice","parent":"project-management","treeview":2,"guard_name":"web"},{"id":164,"name":"view-invoice","parent":"invoice","treeview":2,"guard_name":"web"},{"id":165,"name":"store-invoice","parent":"invoice","treeview":2,"guard_name":"web"},{"id":166,"name":"edit-invoice","parent":"invoice","treeview":2,"guard_name":"web"},{"id":167,"name":"delete-invoice","parent":"invoice","treeview":2,"guard_name":"web"},{"id":277,"name":"store-user","parent":"user","treeview":1,"guard_name":"web"},{"id":278,"name":"last-login-user","parent":"user","treeview":1,"guard_name":"web"},{"id":279,"name":"role-access-user","parent":"user","treeview":1,"guard_name":"web"}]',
                'permission_names' => 'user,view-user,edit-user,delete-user,details-employee,view-details-employee,store-details-employee,modify-details-employee,import-employee,customize-setting,role,view-role,store-role,edit-role,delete-role,set-permission,general-setting,view-general-setting,store-general-setting,mail-setting,view-mail-setting,store-mail-setting,access-variable_type,access-variable_method,access-language,core_hr,view-calendar,promotion,view-promotion,store-promotion,edit-promotion,delete-promotion,award,view-award,store-award,edit-award,delete-award,transfer,view-transfer,store-transfer,edit-transfer,delete-transfer,travel,view-travel,store-travel,edit-travel,delete-travel,resignation,view-resignation,store-resignation,edit-resignation,delete-resignation,complaint,view-complaint,store-complaint,edit-complaint,delete-complaint,warning,view-warning,store-warning,edit-warning,delete-warning,termination,view-termination,store-termination,edit-termination,delete-termination,timesheet,office_shift,view-office_shift,store-office_shift,edit-office_shift,delete-office_shift,project-management,project,view-project,store-project,edit-project,delete-project,assign-project,task,view-task,store-task,edit-task,delete-task,assign-task,client,view-client,store-client,edit-client,delete-client,invoice,view-invoice,store-invoice,edit-invoice,delete-invoice,store-user,last-login-user,role-access-user',
                'permission_ids' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,94,95,96,97,98,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,277,278,279',
                'is_active' => true,
                'position' => 2
            ],
            [
                'name' => 'Premium',
                'is_free_trial' => true,
                'monthly_fee' => 27,
                'yearly_fee' => 270,
                'number_of_user_account' => 100,
                'number_of_employee' => 200,
                'features' => 'user,details-employee,customize-setting,role,general-setting,mail-setting,access-variable_type,access-variable_method,access-language,company,department,designation,location,timesheet,office_shift,performance,goal-type,goal-tracking,indicator,appraisal',
                'permissions' => '[{"id":1,"name":"user","parent":null,"treeview":1},{"id":2,"name":"view-user","parent":"user","treeview":1},{"id":3,"name":"edit-user","parent":"user","treeview":1},{"id":4,"name":"delete-user","parent":"user","treeview":1},{"id":5,"name":"details-employee","parent":null,"treeview":1},{"id":6,"name":"view-details-employee","parent":"details-employee","treeview":1},{"id":7,"name":"store-details-employee","parent":"details-employee","treeview":1},{"id":8,"name":"modify-details-employee","parent":"details-employee","treeview":1},{"id":9,"name":"import-employee","parent":"details-employee","treeview":1},{"id":10,"name":"customize-setting","parent":null,"treeview":1},{"id":11,"name":"role","parent":"customize-setting","treeview":1},{"id":12,"name":"view-role","parent":"role","treeview":1},{"id":13,"name":"store-role","parent":"role","treeview":1},{"id":14,"name":"edit-role","parent":"role","treeview":1},{"id":15,"name":"delete-role","parent":"role","treeview":1},{"id":16,"name":"set-permission","parent":"role","treeview":1},{"id":17,"name":"general-setting","parent":"customize-setting","treeview":1},{"id":18,"name":"view-general-setting","parent":"general-setting","treeview":1},{"id":19,"name":"store-general-setting","parent":"general-setting","treeview":1},{"id":20,"name":"mail-setting","parent":"customize-setting","treeview":1},{"id":21,"name":"view-mail-setting","parent":"mail-setting","treeview":1},{"id":22,"name":"store-mail-setting","parent":"mail-setting","treeview":1},{"id":23,"name":"access-variable_type","parent":"customize-setting","treeview":1},{"id":24,"name":"access-variable_method","parent":"customize-setting","treeview":1},{"id":25,"name":"access-language","parent":"customize-setting","treeview":1},{"id":26,"name":"company","parent":null,"treeview":1},{"id":27,"name":"view-company","parent":"company","treeview":1},{"id":28,"name":"store-company","parent":"company","treeview":1},{"id":29,"name":"edit-company","parent":"company","treeview":1},{"id":30,"name":"delete-company","parent":"company","treeview":1},{"id":31,"name":"department","parent":null,"treeview":1},{"id":32,"name":"view-department","parent":"department","treeview":1},{"id":33,"name":"store-department","parent":"department","treeview":1},{"id":34,"name":"edit-department","parent":"department","treeview":1},{"id":35,"name":"delete-department","parent":"department","treeview":1},{"id":36,"name":"designation","parent":null,"treeview":1},{"id":37,"name":"view-designation","parent":"designation","treeview":1},{"id":38,"name":"store-designation","parent":"designation","treeview":1},{"id":39,"name":"edit-designation","parent":"designation","treeview":1},{"id":40,"name":"delete-designation","parent":"designation","treeview":1},{"id":41,"name":"location","parent":null,"treeview":1},{"id":42,"name":"view-location","parent":"location","treeview":1},{"id":43,"name":"store-location","parent":"location","treeview":1},{"id":44,"name":"edit-location","parent":"location","treeview":1},{"id":45,"name":"delete-location","parent":"location","treeview":1},{"id":88,"name":"timesheet","parent":null,"treeview":2},{"id":94,"name":"office_shift","parent":"timesheet","treeview":2},{"id":95,"name":"view-office_shift","parent":"office_shift","treeview":2},{"id":96,"name":"store-office_shift","parent":"office_shift","treeview":2},{"id":97,"name":"edit-office_shift","parent":"office_shift","treeview":2},{"id":98,"name":"delete-office_shift","parent":"office_shift","treeview":2},{"id":256,"name":"performance","parent":null,"treeview":3},{"id":257,"name":"goal-type","parent":"performance","treeview":3},{"id":258,"name":"view-goal-type","parent":"goal-type","treeview":3},{"id":259,"name":"store-goal-type","parent":"goal-type","treeview":3},{"id":260,"name":"edit-goal-type","parent":"goal-type","treeview":3},{"id":261,"name":"delete-goal-type","parent":"goal-type","treeview":3},{"id":262,"name":"goal-tracking","parent":"performance","treeview":3},{"id":263,"name":"view-goal-tracking","parent":"goal-tracking","treeview":3},{"id":264,"name":"store-goal-tracking","parent":"goal-tracking","treeview":3},{"id":265,"name":"edit-goal-tracking","parent":"goal-tracking","treeview":3},{"id":266,"name":"delete-goal-tracking","parent":"goal-tracking","treeview":3},{"id":267,"name":"indicator","parent":"performance","treeview":3},{"id":268,"name":"view-indicator","parent":"indicator","treeview":3},{"id":269,"name":"store-indicator","parent":"indicator","treeview":3},{"id":270,"name":"edit-indicator","parent":"indicator","treeview":3},{"id":271,"name":"delete-indicator","parent":"indicator","treeview":3},{"id":272,"name":"appraisal","parent":"performance","treeview":3},{"id":273,"name":"view-appraisal","parent":"appraisal","treeview":3},{"id":274,"name":"store-appraisal","parent":"appraisal","treeview":3},{"id":275,"name":"edit-appraisal","parent":"appraisal","treeview":3},{"id":276,"name":"delete-appraisal","parent":"appraisal","treeview":3}]',
                'permission_names' => 'user,view-user,edit-user,delete-user,details-employee,view-details-employee,store-details-employee,modify-details-employee,import-employee,customize-setting,role,view-role,store-role,edit-role,delete-role,set-permission,general-setting,view-general-setting,store-general-setting,mail-setting,view-mail-setting,store-mail-setting,access-variable_type,access-variable_method,access-language,company,view-company,store-company,edit-company,delete-company,department,view-department,store-department,edit-department,delete-department,designation,view-designation,store-designation,edit-designation,delete-designation,location,view-location,store-location,edit-location,delete-location,timesheet,office_shift,view-office_shift,store-office_shift,edit-office_shift,delete-office_shift,performance,goal-type,view-goal-type,store-goal-type,edit-goal-type,delete-goal-type,goal-tracking,view-goal-tracking,store-goal-tracking,edit-goal-tracking,delete-goal-tracking,indicator,view-indicator,store-indicator,edit-indicator,delete-indicator,appraisal,view-appraisal,store-appraisal,edit-appraisal,delete-appraisal',
                'permission_ids' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,88,94,95,96,97,98,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276',
                'is_active' => true,
                'position' => 3
            ],
        ];

        Package::insert($data);
    }
}
