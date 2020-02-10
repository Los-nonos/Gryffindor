import IPresenter from '../Base/IPresenter';
import Room from '../../../../Domain/Entities/Room';

class CreateRoomPresenter implements IPresenter {
  private message: string;
  private result: Room;
  constructor(result: Room, message: string) {
    this.result = result;
    this.message = message;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    return {
      message: this.message,
      result: {
        id: this.result.Id,
        name: this.result.Name,
      },
    };
  }
}

export default CreateRoomPresenter;
