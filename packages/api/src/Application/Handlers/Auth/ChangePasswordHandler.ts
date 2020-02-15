import { inject, injectable } from 'inversify';
import ChangePasswordCommand from '../../Commands/Auth/ChangePasswordCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import IUserRepository from '../../../Domain/Interfaces/IUserRepository';
import { UnAuthorizedError } from '../../../API/Http/Errors/UnAuthorizedException';

@injectable()
class ChangePasswordHandler {
  private repository: IUserRepository;
  constructor(@inject(INTERFACES.IUserRepository) repository: IUserRepository) {
    this.repository = repository;
  }
  public async execute(command: ChangePasswordCommand): Promise<void> {
    const user = await this.repository.FindById(command.getId());

    if (!user.checkPasswordUnhashedIsValid(command.getOldPassword())) {
      throw new UnAuthorizedError(`Password invalid`);
    }
    user.hashPassword(command.getNewPassword());
    await this.repository.Update(user);
  }
}

export default ChangePasswordHandler;
