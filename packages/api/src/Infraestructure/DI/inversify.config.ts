import { Container } from 'inversify';
import 'reflect-metadata';
import INTERFACES from './types';

import LoginAction from '../../API/Http/Actions/Auth/LoginAction';
import ChangePasswordAction from '../../API/Http/Actions/Auth/ChangePasswordAction';

import CreateUserAction from '../../API/Http/Actions/User/CreateUserAction';
import EditUserAction from '../../API/Http/Actions/User/EditUserAction';
import DeleteUserAction from '../../API/Http/Actions/User/DeleteUserAction';
import FindByIdUserAction from '../../API/Http/Actions/User/FindByIdUserAction';
import FindUserAction from '../../API/Http/Actions/User/FindUserAction';

import CreateUserRoleAction from '../../API/Http/Actions/UserRole/CreateUserRoleAction';
import EditUserRoleAction from '../../API/Http/Actions/UserRole/EditUserRoleAction';
import DeleteUserRoleAction from '../../API/Http/Actions/UserRole/DeleteUserRoleAction';
import FindByIdUserRoleAction from '../../API/Http/Actions/UserRole/FindByIdUserRoleAction';
import FindUserRoleAction from '../../API/Http/Actions/UserRole/FindUserRoleAction';

import LoginAdapter from '../../API/Http/Adapters/Auth/LoginAdapter';
import ChangePasswordAdapter from '../../API/Http/Adapters/Auth/ChangePasswordAdapter';

import CreateUserAdapter from '../../API/Http/Adapters/User/CreateUserAdapter';
import EditUserAdapter from '../../API/Http/Adapters/User/EditUserAdapter';
import DeleteUserAdapter from '../../API/Http/Adapters/User/DeleteUserAdapter';
import FindByIdUserAdapter from '../../API/Http/Adapters/User/FindByIdUserAdapter';
import FindUserAdapter from '../../API/Http/Adapters/User/FindUserAdapter';

import CreateUserRoleAdapter from '../../API/Http/Adapters/UserRole/CreateUserRoleAdapter';
import EditUserRoleAdapter from '../../API/Http/Adapters/UserRole/EditUserRoleAdapter';
import DeleteUserRoleAdapter from '../../API/Http/Adapters/UserRole/DeleteUserRoleAdapter';
import FindByIdUserRoleAdapter from '../../API/Http/Adapters/UserRole/FindByIdUserRoleAdapter';
import FindUserRoleAdapter from '../../API/Http/Adapters/UserRole/FindUserRoleAdapter';

import LoginHandler from '../../Application/Handlers/Auth/LoginHandler';
import ChangePasswordHandler from '../../Application/Handlers/Auth/ChangePasswordHandler';

import CreateUserHandler from '../../Application/Handlers/User/CreateUserHandler';
import EditUserHandler from '../../Application/Handlers/User/EditUserHandler';
import DeleteUserHandler from '../../Application/Handlers/User/DeleteUserHandler';
import FindByIdUserHandler from '../../Application/Handlers/User/FindByIdUserHandler';
import FindUserHandler from '../../Application/Handlers/User/FindUserHandler';

import CreateUserRoleHandler from '../../Application/Handlers/UserRole/CreateUserRoleHandler';
import EditUserRoleHandler from '../../Application/Handlers/UserRole/EditUserRoleHandler';
import DeleteUserRoleHandler from '../../Application/Handlers/UserRole/DeleteUserRoleHandler';
import FindByIdUserRoleHandler from '../../Application/Handlers/UserRole/FindByIdUserRoleHandler';
import FindUserRoleHandler from '../../Application/Handlers/UserRole/FindUserRoleHandler';

import IUserRepository from '../../Domain/Interfaces/IUserRepository';
import IUserRoleRepository from '../../Domain/Interfaces/IUserRoleRepository';

import UserRepository from '../../Persistance/Repositories/UserRepository';
import UserRoleRepository from '../../Persistance/Repositories/UserRoleRepository';

//Erros imports
import ErrorHandler from '../utils/ErrorHandler';

import Validator from '../../API/Http/Validator/Validator';

var container = new Container();

container.bind<LoginAction>(LoginAction).toSelf();
container.bind<ChangePasswordAction>(ChangePasswordAction).toSelf();

container.bind<CreateUserAction>(CreateUserAction).toSelf();
container.bind<EditUserAction>(EditUserAction).toSelf();
container.bind<DeleteUserAction>(DeleteUserAction).toSelf();
container.bind<FindByIdUserAction>(FindByIdUserAction).toSelf();
container.bind<FindUserAction>(FindUserAction).toSelf();

container.bind<CreateUserRoleAction>(CreateUserRoleAction).toSelf();
container.bind<EditUserRoleAction>(EditUserRoleAction).toSelf();
container.bind<DeleteUserRoleAction>(DeleteUserRoleAction).toSelf();
container.bind<FindByIdUserRoleAction>(FindByIdUserRoleAction).toSelf();
container.bind<FindUserRoleAction>(FindUserRoleAction).toSelf();

container.bind<LoginAdapter>(LoginAdapter).toSelf();
container.bind<ChangePasswordAdapter>(ChangePasswordAdapter).toSelf();

container.bind<CreateUserAdapter>(CreateUserAdapter).toSelf();
container.bind<EditUserAdapter>(EditUserAdapter).toSelf();
container.bind<DeleteUserAdapter>(DeleteUserAdapter).toSelf();
container.bind<FindByIdUserAdapter>(FindByIdUserAdapter).toSelf();
container.bind<FindUserAdapter>(FindUserAdapter).toSelf();

container.bind<CreateUserRoleAdapter>(CreateUserRoleAdapter).toSelf();
container.bind<EditUserRoleAdapter>(EditUserRoleAdapter).toSelf();
container.bind<DeleteUserRoleAdapter>(DeleteUserRoleAdapter).toSelf();
container.bind<FindByIdUserRoleAdapter>(FindByIdUserRoleAdapter).toSelf();
container.bind<FindUserRoleAdapter>(FindUserRoleAdapter).toSelf();

container.bind<LoginHandler>(LoginHandler).toSelf();
container.bind<ChangePasswordHandler>(ChangePasswordHandler).toSelf();

container.bind<CreateUserHandler>(CreateUserHandler).toSelf();
container.bind<EditUserHandler>(EditUserHandler).toSelf();
container.bind<DeleteUserHandler>(DeleteUserHandler).toSelf();
container.bind<FindByIdUserHandler>(FindByIdUserHandler).toSelf();
container.bind<FindUserHandler>(FindUserHandler).toSelf();

container.bind<CreateUserRoleHandler>(CreateUserRoleHandler).toSelf();
container.bind<EditUserRoleHandler>(EditUserRoleHandler).toSelf();
container.bind<DeleteUserRoleHandler>(DeleteUserRoleHandler).toSelf();
container.bind<FindByIdUserRoleHandler>(FindByIdUserRoleHandler).toSelf();
container.bind<FindUserRoleHandler>(FindUserRoleHandler).toSelf();

container.bind<IUserRepository>(INTERFACES.IUserRepository).to(UserRepository);
container.bind<IUserRoleRepository>(INTERFACES.IUserRolesRepository).to(UserRoleRepository);

// Errors services
container.bind<ErrorHandler>(ErrorHandler).toSelf();

container.bind<Validator>(Validator).toSelf();

export default container;
