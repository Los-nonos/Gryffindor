import { inject, injectable } from 'inversify';
import EditUserCommand from '../../Commands/User/EditUserCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import IUserRepository from '../../../Domain/Interfaces/IUserRepository';
import User from '../../../Domain/Entities/User';

@injectable()
class EditUserHandler {
  private readonly repository: IUserRepository;
  constructor(@inject(INTERFACES.IUserRepository) repository: IUserRepository) {
    this.repository = repository;
  }
  public async execute(command: EditUserCommand): Promise<User> {
    const user = await this.repository.FindById(command.getId());

    if (!user) {
      throw new EntityNotFound(`not found user with id ${command.getId()}`);
    }

    user.Email = command.getEmail();
    user.Name = command.getName();
    user.Phone = command.getPhone();

    await this.repository.Update(user);

    return user;
  }
}

export default EditUserHandler;
