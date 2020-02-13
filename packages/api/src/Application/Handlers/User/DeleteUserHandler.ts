import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import DeleteUserCommand from '../../Commands/User/DeleteUserCommand';

@injectable()
class DeleteUserHandler
{
	constructor() {}
	public async execute(command: DeleteUserCommand): Promise<any> {
	}
}

export default DeleteUserHandler;
