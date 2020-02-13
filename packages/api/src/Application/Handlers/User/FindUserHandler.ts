import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import FindUserCommand from '../../Commands/User/FindUserCommand';

@injectable()
class FindUserHandler
{
	constructor() {}
	public async execute(command: FindUserCommand): Promise<any> {
	}
}

export default FindUserHandler;
