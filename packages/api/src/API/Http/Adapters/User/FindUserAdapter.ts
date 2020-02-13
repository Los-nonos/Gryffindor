import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import FindUserCommand from '../../../../Application/Commands/User/FindUserCommand';
import FindUserSchema from '../../Validator/Schemas/UserSchema';

@injectable()
class FindUserAdapter
{
	private validator: Validator;
	constructor(@inject(Validator) validator: Validator) {
		this.validator = validator;
	}
	public async from(req: Request): Promise<FindUserCommand> {
		const error = this.validator.validate(req.params, FindUserSchema);
		if(error) {
			throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
		}
		return new FindUserCommand(req.body);
	}
}

export default FindUserAdapter;
