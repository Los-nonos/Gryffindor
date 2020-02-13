import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import FindByIdUserCommand from '../../Commands/User/FindByIdUserCommand';

@injectable()
class FindByIdUserHandler
{
	constructor() {}
	public async execute(command: FindByIdUserCommand): Promise<any> {
	}
}

export default FindByIdUserHandler;
