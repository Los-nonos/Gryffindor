import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import CreateUserCommand from '../../Commands/User/CreateUserCommand';

@injectable()
class CreateUserHandler
{
	constructor() {}
	public async execute(command: CreateUserCommand): Promise<any> {
	}
}

export default CreateUserHandler;
