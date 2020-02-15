import { inject, injectable } from 'inversify';
import CreateUserCommand from '../../Commands/User/CreateUserCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import IUserRepository from '../../../Domain/Interfaces/IUserRepository';
import { UnprocessableEntity } from '../../../API/Http/Errors/UnprocessableEntity';
import User from '../../../Domain/Entities/User';

@injectable()
class CreateUserHandler {
  private repository: IUserRepository;
  constructor(@inject(INTERFACES.IUserRepository) repository: IUserRepository) {
    this.repository = repository;
  }
  public async execute(command: CreateUserCommand): Promise<User> {
    let user = await this.repository.FindByName(command.getName());

    if (user) {
      throw new UnprocessableEntity(`user with name ${command.getName()} is already exist`);
    }

    user = new User();
    user.Name = command.getName();
    user.Email = command.getEmail();
    user.Phone = command.getPhone();
    user.hashPassword(command.getPassword());

    return await this.repository.Persist(user);
  }
}

export default CreateUserHandler;
