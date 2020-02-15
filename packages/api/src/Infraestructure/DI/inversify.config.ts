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

import LoginAdapter from '../../API/Http/Adapters/Auth/LoginAdapter';
import ChangePasswordAdapter from '../../API/Http/Adapters/Auth/ChangePasswordAdapter';

import CreateUserAdapter from '../../API/Http/Adapters/User/CreateUserAdapter';
import EditUserAdapter from '../../API/Http/Adapters/User/EditUserAdapter';
import DeleteUserAdapter from '../../API/Http/Adapters/User/DeleteUserAdapter';
import FindByIdUserAdapter from '../../API/Http/Adapters/User/FindByIdUserAdapter';
import FindUserAdapter from '../../API/Http/Adapters/User/FindUserAdapter';

import LoginHandler from '../../Application/Handlers/Auth/LoginHandler';
import ChangePasswordHandler from '../../Application/Handlers/Auth/ChangePasswordHandler';

import CreateUserHandler from '../../Application/Handlers/User/CreateUserHandler';
import EditUserHandler from '../../Application/Handlers/User/EditUserHandler';
import DeleteUserHandler from '../../Application/Handlers/User/DeleteUserHandler';
import FindByIdUserHandler from '../../Application/Handlers/User/FindByIdUserHandler';
import FindUserHandler from '../../Application/Handlers/User/FindUserHandler';

import IUserRepository from '../../Domain/Interfaces/IUserRepository';

import UserRepository from '../../Persistance/Repositories/UserRepository';

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

container.bind<LoginAdapter>(LoginAdapter).toSelf();
container.bind<ChangePasswordAdapter>(ChangePasswordAdapter).toSelf();

container.bind<CreateUserAdapter>(CreateUserAdapter).toSelf();
container.bind<EditUserAdapter>(EditUserAdapter).toSelf();
container.bind<DeleteUserAdapter>(DeleteUserAdapter).toSelf();
container.bind<FindByIdUserAdapter>(FindByIdUserAdapter).toSelf();
container.bind<FindUserAdapter>(FindUserAdapter).toSelf();

container.bind<LoginHandler>(LoginHandler).toSelf();
container.bind<ChangePasswordHandler>(ChangePasswordHandler).toSelf();

container.bind<CreateUserHandler>(CreateUserHandler).toSelf();
container.bind<EditUserHandler>(EditUserHandler).toSelf();
container.bind<DeleteUserHandler>(DeleteUserHandler).toSelf();
container.bind<FindByIdUserHandler>(FindByIdUserHandler).toSelf();
container.bind<FindUserHandler>(FindUserHandler).toSelf();

container.bind<IUserRepository>(INTERFACES.IUserRepository).to(UserRepository);

// Errors services
container.bind<ErrorHandler>(ErrorHandler).toSelf();

container.bind<Validator>(Validator).toSelf();

export default container;
