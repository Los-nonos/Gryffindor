import { inject, injectable } from 'inversify';
import DeleteUserCommand from '../../Commands/User/DeleteUserCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import IUserRepository from '../../../Domain/Interfaces/IUserRepository';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';

@injectable()
class DeleteUserHandler {
  private readonly repository: IUserRepository;
  constructor(@inject(INTERFACES.IUserRepository) repository: IUserRepository) {
    this.repository = repository;
  }
  public async execute(command: DeleteUserCommand): Promise<void> {
    const user = await this.repository.FindById(command.getId());

    if (!user) {
      throw new EntityNotFound(`not found user with id ${command.getId()}`);
    }

    await this.repository.Delete(user);
  }
}

export default DeleteUserHandler;
