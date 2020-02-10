import IPresenter from '../Base/IPresenter';

class DeleteRoomPresenter implements IPresenter {
  private message: string;
  constructor(message: string) {
    this.message = message;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    return { message: this.message };
  }
}

export default DeleteRoomPresenter;
