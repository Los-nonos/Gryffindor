<?php

return [

    'buses' => [

        'default' => [

            'commandbus' => 'League\Tactician\CommandBus',

            'middleware' => [
                // ...
            ],

            'commmands' => [

                /*CompanyAdmin*/
                'CreateCompanyAdmin' => [
                    'command' => 'Application\Commands\CompanyAdmin\CreateCompanyAdminCommand',
                    'handler' => 'Application\Handlers\CompanyAdmin\CreateCompanyAdminHandler'
                ],
                'EditCompanyAdmin' => [
                    'command' => 'Application\Commands\CompanyAdmin\EditCompanyAdminCommand',
                    'handler' => 'Application\Handlers\CompanyAdmin\EditCompanyAdminHandler'
                ],
                'GetCompanyAdmin' => [
                    'command' => 'Application\Commands\CompanyAdmin\GetCompanyAdminCommand',
                    'handler' => 'Application\Handlers\CompanyAdmin\GetCompanyAdminHandler'
                ],

                /*Course*/
                'CreateCourse' => [
                    'command' => 'Application\Commands\Course\CreateCourseCommand',
                    'handler' => 'Application\Handlers\Course\CreateCourseHandler'
                ],
                'EditCourse' => [
                    'command' => 'Application\Commands\Course\EditCourseCommand',
                    'handler' => 'Application\Handlers\Course\EditCourseHandler'
                ],
                'GetCourse' => [
                    'command' => 'Application\Commands\Course\GetCourseCommand',
                    'handler' => 'Application\Handlers\Course\GetCourseHandler'
                ],
                'CancelCourse' => [
                    'command' => 'Application\Commands\Course\CancelCourseCommand',
                    'handler' => 'Application\Handlers\Course\CancelCourseHandler'
                ],
                'GetAllCourses' => [
                    'command' => 'Application\Commands\Course\GetAllCoursesCommand',
                    'handler' => 'Application\Handlers\Course\GetAllCoursesHandler'
                ],
                'GetCoursesByQueryCommand' => [
                    'command' => 'Application\Commands\Course\GetCoursesByQueryCommand',
                    'handler' => 'Application\Handlers\Course\GetCoursesByQueryHandler'
                ],

                /*Manager*/
                'CreateManager' => [
                    'command' => 'Application\Commands\Manager\CreateManagerCommand',
                    'handler' => 'Application\Handlers\Manager\CreateManagerHandler'
                ],

                /*Organization*/
                'EditOrganization' => [
                    'command' => 'Application\Commands\Organization\EditOrganizationCommand',
                    'handler' => 'Application\Handlers\Organization\EditOrganizationHandler'
                ],
                'GetOrganization' => [
                    'command' => 'Application\Commands\Organization\GetOrganizationCommand',
                    'handler' => 'Application\Handlers\Organization\GetOrganizationHandler'
                ],

                /*Tag*/
                'EditTag' => [
                    'command' => 'Application\Commands\Tag\EditTagCommand',
                    'handler' => 'Application\Handlers\Tag\EditTagHandler'
                ],
                'GetTag' => [
                    'command' => 'Application\Commands\Tag\GetTagCommand',
                    'handler' => 'Application\Handlers\Tag\GetTagHandler'
                ],

                /*Teacher*/
                'CreateTeacher' => [
                    'command' => 'Application\Commands\Teacher\CreateTeacherCommand',
                    'handler' => 'Application\Handlers\Teacher\CreateTeacherHandler'
                ],

                /*User*/
                'CreateUser' => [
                    'command' => 'Application\Commands\User\CreateUserCommand',
                    'handler' => 'Application\Handlers\User\CreateUserHandler'
                ],
                'EditUser' => [
                    'command' => 'Application\Commands\User\EditUserCommand',
                    'handler' => 'Application\Handlers\User\EditUserHandler'
                ],
                'GetUser' => [
                    'command' => 'Application\Commands\User\GetUserCommand',
                    'handler' => 'Application\Handlers\User\GetUserHandler'
                ],
            ],

        ],

    ],
];
