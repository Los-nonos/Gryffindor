import { inject, injectable } from 'inversify';
import LoginCommand from '../../Commands/Auth/LoginCommand';

@injectable()
class LoginHandler
{
	constructor() {}
	public async execute(command: LoginCommand): Promise<any> {
	}
}

export default LoginHandler;
