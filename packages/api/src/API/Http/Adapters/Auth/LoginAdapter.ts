import { Request } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import LoginCommand from '../../../../Application/Commands/Auth/LoginCommand';
import { LoginSchema } from '../../Validator/Schemas/LoginSchema';

@injectable()
class LoginAdapter
{
	private validator: Validator;
	constructor(@inject(Validator) validator: Validator) {
		this.validator = validator;
	}
	public async from(req: Request): Promise<LoginCommand> {
		const error = this.validator.validate(req.body, LoginSchema);
		if(error) {
			throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
		}
		return new LoginCommand(req.body.username, req.body.password);
	}
}

export default LoginAdapter;
