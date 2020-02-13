import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import EditUserCommand from '../../Commands/User/EditUserCommand';

@injectable()
class EditUserHandler
{
	constructor() {}
	public async execute(command: EditUserCommand): Promise<any> {
	}
}

export default EditUserHandler;
